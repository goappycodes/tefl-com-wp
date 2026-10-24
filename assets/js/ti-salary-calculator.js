jQuery(document).ready(function ($) {
  const CONFIG = {
    FORM_ID: '3901', 
    ERROR_TIMEOUT: 5000,
    DEBOUNCE_DELAY: 300
  };

  const VALIDATION = {
    email: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
    name: /^[a-zA-Z\s'-]{2,}$/,
    phone: /^[\d\s\-\+\(\)]{7,}$/,
    country: /^.{2,}$/
  };

  // Initially hide single-page form and loading
  $('.single-page-form').hide();
  $('.loading-div').hide();

  // Show country input iff Teaching Abroad is selected
  function toggleCountryInput() {
    const teachingType = $('input[name="teaching-type"]:checked').val();
    if (teachingType === 'Teaching Abroad') {
      $('.country-container').slideDown();
    } else {
      $('.country-container').slideUp();
      $('input[name="country-text"]').val('');
    }
  }

  // On clicking Get Started: hide intro and show form, disable submit
  $('.get-started-btn').on('click', function (e) {
    e.preventDefault();
    $('.info-text').fadeOut(400, () => {
      $('.single-page-form').fadeIn(400);
      disableSubmitButton();
    });
  });

  // Terms checkbox enables or disables submit
  $(document).on('change', '.agree-terms input', function () {
    if (this.checked) {
      $('.single-page-form input[type="submit"]').removeAttr('disabled');
    } else {
      disableSubmitButton();
    }
  });

  // Show/hide country input on teaching-type change
  $(document).on('change', 'input[name="teaching-type"]', toggleCountryInput);

  function disableSubmitButton() {
    $('.single-page-form input[type="submit"]').attr('disabled', 'disabled');
  }

  // Validation helpers with error display
  function showError(message) {
    clearError();
    const errorHtml = `
      <div class="error-message" role="alert" aria-live="assertive" style="margin-bottom:20px; color:#b00020; font-weight:600;">
        <i class="fa fa-exclamation-triangle" style="margin-right: 8px;"></i>${message}
      </div>`;
    $('.single-page-form').prepend(errorHtml);
    setTimeout(() => {
      $('.error-message').fadeOut(300, function () { $(this).remove(); });
    }, CONFIG.ERROR_TIMEOUT);
  }

  function clearError() {
    $('.error-message').remove();
  }

  function validateName() {
    clearError();
    const firstName = $('input[name="first-name"]').val().trim();
    const lastName = $('input[name="last-name"]').val().trim();
    const valid = VALIDATION.name.test(firstName) && VALIDATION.name.test(lastName);
    if (!valid && (firstName || lastName)) {
      showError('Please enter valid first and last names (at least 2 letters each, letters only).');
    }
    return valid;
  }

  function validateEmail() {
    clearError();
    const email = $('input[name="your-email"]').val().trim();
    const valid = VALIDATION.email.test(email);
    if (!valid && email) {
      showError('Please enter a valid email address.');
    }
    return valid;
  }

  function validatePhone() {
    clearError();
    const phone = $('input[name="phone"]').val().trim();
    const valid = VALIDATION.phone.test(phone);
    if (!valid && phone) {
      showError('Please enter a valid phone number (at least 7 digits).');
    }
    return valid;
  }

  function validateCountry() {
    clearError();
    const teachingType = $('input[name="teaching-type"]:checked').val() || '';
    if (teachingType !== 'Teaching Abroad') return true;
    const country = $('input[name="country-text"]').val().trim();
    const valid = VALIDATION.country.test(country);
    if (!valid && country) {
      showError('Please enter a valid country name (at least 2 characters).');
    }
    return valid;
  }

  // When submitted via CF7 event
  document.addEventListener('wpcf7submit', function (event) {
    if (CONFIG.FORM_ID !== event.detail.contactFormId.toString()) return;

    // Validate all required inputs before proceeding
    if (!validateName() || !validateEmail() || !validatePhone() || !validateCountry()) {
      event.preventDefault();
      showError('Please correct the validation errors before submitting.');
      return false;
    }

    const formData = {};
    event.detail.inputs.forEach(i => formData[i.name] = i.value);

    $('.loading-div').show();
    $('.wpcf7-response-output').empty();

    generateAIEstimate(formData);
  }, false);

  // Optional: handle invalid events - currently left empty
  document.addEventListener('wpcf7invalid', function (event) {});

  // Generate AI estimate via AJAX
  function generateAIEstimate(formData) {
    const prompt = createAIPrompt(formData);

    $.ajax({
      url: ti_obj.ti_ajax,
      type: 'POST',
      data: {
        action: 'generate_tefl_salary_estimate',
        prompt: prompt,
        form_data: JSON.stringify(formData),
      },
      timeout: 30000,
      success: function (response) {
        if (response.success && response.data.estimate) {
          displayAIResult(response.data.estimate, formData);
        } else {
          displayFallbackResult(formData);
        }
      },
      error: function () {
        displayFallbackResult(formData);
      }
    });
  }

  function createAIPrompt(formData) {
    const teachingType = formData['teaching-type'] || 'Unknown';
    const country = formData['country-text'] || 'Not specified';
    const qualification = formData['tefl-qualification'] || 'Unknown';
    const education = formData['level-of-education'] || 'Unknown';
    const passport = formData['passport-country'] || 'Unknown';
    const experience = formData['tefl-experience'] || 'Unknown';
    
    let prompt = `You are a comprehensive TEFL salary expert. Analyze this teacher profile and provide detailed, actionable insights:\n\n`;
    
    prompt += `TEACHER PROFILE:\n`;
    prompt += `• Teaching Preference: ${teachingType}\n`;
    
    if (teachingType === 'Teaching Abroad' && country !== 'Not specified') {
        prompt += `• Target Country: ${country}\n`;
    }
    
    prompt += `• TEFL Qualification: ${qualification}\n`;
    prompt += `• Education Level: ${education}\n`;
    prompt += `• Passport/Nationality: ${passport}\n`;
    prompt += `• Teaching Experience: ${experience}\n\n`;
    
    if (teachingType === 'Teaching Abroad' && country !== 'Not specified') {
        prompt += `ANALYSIS REQUIRED FOR ${country.toUpperCase()}:\n\n`;
        prompt += `1. SALARY ESTIMATE:\n`;
        prompt += `   - Provide monthly salary range in the local currency of ${country}\n`;
        prompt += `   - Include both entry-level and experienced teacher ranges\n`;
        prompt += `   - Consider this teacher's specific qualifications\n\n`;
        
        prompt += `2. DETAILED MARKET ANALYSIS:\n`;
        prompt += `   - Current demand for English teachers in ${country}\n`;
        prompt += `   - How this teacher's qualifications compare to market standards\n`;
        prompt += `   - Cost of living context (what this salary means in real terms)\n`;
        prompt += `   - Peak hiring seasons and best cities/regions\n\n`;
        
        prompt += `3. STRATEGIC CAREER ADVICE:\n`;
        prompt += `   - Specific steps to increase earning potential in ${country}\n`;
        prompt += `   - Which additional qualifications would have the biggest impact\n`;
        prompt += `   - How to leverage their current background effectively\n`;
        prompt += `   - Networking and job search strategies specific to ${country}\n\n`;
        
        prompt += `4. PRACTICAL CONSIDERATIONS:\n`;
        prompt += `   - Visa requirements and work permit process\n`;
        prompt += `   - Tax implications and take-home pay reality\n`;
        prompt += `   - Benefits typically offered (housing, flights, insurance)\n`;
        prompt += `   - Cultural workplace expectations\n\n`;
    } else {
        prompt += `ANALYSIS REQUIRED FOR ONLINE TEACHING:\n\n`;
        prompt += `1. HOURLY RATE ESTIMATE:\n`;
        prompt += `   - Provide realistic hourly rate range in EUR (€)\n`;
        prompt += `   - Consider platform rates vs. private student rates\n`;
        prompt += `   - Factor in this teacher's specific qualifications\n\n`;
        
        prompt += `2. MARKET POSITIONING:\n`;
        prompt += `   - How to price competitively based on their qualifications\n`;
        prompt += `   - Which platforms/markets suit their profile best\n`;
        prompt += `   - Student demographics they should target\n`;
        prompt += `   - Peak demand hours and scheduling strategies\n\n`;
        
        prompt += `3. INCOME OPTIMIZATION:\n`;
        prompt += `   - Strategies to increase rates over time\n`;
        prompt += `   - Additional services they could offer (conversation, business English, exam prep)\n`;
        prompt += `   - How to build a loyal student base\n`;
        prompt += `   - Multiple income stream opportunities\n\n`;
        
        prompt += `4. PROFESSIONAL DEVELOPMENT:\n`;
        prompt += `   - Key skills to develop for online teaching success\n`;
        prompt += `   - Technology and platform mastery tips\n`;
        prompt += `   - Marketing and personal branding advice\n`;
        prompt += `   - Long-term career progression paths\n\n`;
    }
    
    prompt += `RESPONSE FORMAT:\n`;
    prompt += `Provide a comprehensive JSON response with these exact keys:\n`;
    prompt += `{\n`;
    prompt += `  "salary_display": "Clear salary range with currency symbol",\n`;
    prompt += `  "market_analysis": "150-200 word detailed market context and positioning",\n`;
    prompt += `  "strategic_tip": "Specific, actionable advice for immediate improvement (80-120 words)",\n`;
    prompt += `  "long_term_strategy": "Career development roadmap (100-150 words)",\n`;
    prompt += `  "practical_insights": "Real-world considerations and insider tips (80-120 words)"\n`;
    prompt += `}\n\n`;
    
    prompt += `Make your advice specific, actionable, and valuable. Avoid generic tips.`;
    
    return prompt;
  }


  // Replace the form with result HTML when AI estimate is received
  function displayAIResult(estimate, formData) {
    let parsedEstimate = null;
    try {
      parsedEstimate = (typeof estimate === 'string') ? JSON.parse(estimate) : estimate;
      // Parse nested JSON if necessary
      Object.keys(parsedEstimate).forEach(key => {
        if (typeof parsedEstimate[key] === 'string' && parsedEstimate[key].trim().startsWith('{')) {
          try {
            const nested = JSON.parse(parsedEstimate[key]);
            if (nested.salary_display || nested.market_analysis) parsedEstimate = nested;
          } catch (_) {}
        }
      });
    } catch (e) {
      parsedEstimate = parseTextEstimate(estimate, formData);
    }

    const resultHtml = generateSimpleResultHtml(parsedEstimate, formData);

    // Replace the entire form container content with the result HTML
    $('.salary-calculator-form').html(resultHtml);
  }

  // Fallback result shown if AI estimate fails
  function displayFallbackResult(formData) {
    const score = calculateSalaryScore(formData);
    const html = generateFallbackResultHtml(score);

    // Replace form content with fallback result
    $('.salary-calculator-form').html(html);
  }

  // Helper: parse text response fallback
  function parseTextEstimate(textEstimate, formData) {
    const salaryMatch = textEstimate.match(/[\d,]+(?:\.\d+)?\s*[-–—]\s*[\d,]+(?:\.\d+)?/);

    let salaryDisplay = 'Contact us for personalized estimate';
    if (salaryMatch) {
      const currencyMatch = textEstimate.match(/([€$£¥₹₽¢₩₡₪₫₾₵₴₸₺₼＄￠￡￥]|[A-Z]{3})/);
      const currency = currencyMatch ? currencyMatch[1] : '€';
      salaryDisplay = `${currency}${salaryMatch[0]}`;
    }

    return {
      salary_display: salaryDisplay,
      market_analysis: 'Based on your qualifications and current market conditions, this estimate reflects realistic earning potential.',
      strategic_tip: 'Consider gaining additional qualifications to increase your earning potential.',
      long_term_strategy: 'Focus on building experience and expanding your skill set.',
      practical_insights: 'Research specific market requirements and prepare accordingly.'
    };
  }

  // Generate simple salary result HTML (reused from original code)
  function generateSimpleResultHtml(estimate, formData) {
    const teachingType = formData['teaching-type'] || 'Unknown';
    const country = formData['country-text'] || 'Not specified';

    const salaryDisplay = cleanText(estimate.salary_display) || 'Contact us for estimate';
    const marketAnalysis = cleanText(estimate.market_analysis) || 'Based on your profile and current market conditions, this estimate reflects realistic earning potential in your chosen field.';
    const strategicTip = cleanText(estimate.strategic_tip) || 'Consider gaining additional qualifications and practical teaching experience to increase your earning potential.';

    let titleText = 'Your TEFL Earning Potential';
    if (teachingType === 'Teaching Abroad' && country !== 'Not specified') {
      titleText = `Teaching in ${country}`;
    } else if (teachingType === 'Teaching Online') {
      titleText = 'Online Teaching Rates';
    }

    return `
      <div class="salary-result-content">
        <h2 class="result-title">${titleText}</h2>
        <div class="salary-display"><strong>${salaryDisplay}</strong></div>
        <section class="market-explanation">
          <h3>Market Analysis</h3>
          <p>${marketAnalysis}</p>
        </section>
        <section class="career-tip">
          <h3>💡 Career Tip</h3>
          <p>${strategicTip}</p>
        </section>
        <section class="disclaimer-section">
          <p class="disclaimer-text">
            * This analysis uses current market data and AI insights. Individual results may vary based on specific circumstances and market conditions.
          </p>
        </section>
      </div>
    `;
  }

  // Clean text helper (from your code)
  function cleanText(text) {
    if (!text) return '';
    text = text.replace(/^\s*{\s*"[^"]*"\s*:\s*"/, '').replace(/"\s*}\s*$/, '');
    text = text.replace(/\\"/g, '"').replace(/\\n/g, ' ').replace(/\s+/g, ' ');
    text = text.replace(/^["{}\s]+|["{}\s]+$/g, '');
    return text.trim();
  }

  // Calculate fallback score for salary estimate
  function calculateSalaryScore(formData) {
    const scoring = {
      'tefl-qualification': {
        '120 hour TEFL Certificate': 1,
        'Level 5/CELTA Certificate': 2,
        'No qualification yet': 0
      },
      'level-of-education': {
        'High school diploma, A-levels, or equivalent': 0,
        "Associates or Bachelor's degree": 2,
        "Master's degree or above": 2
      },
      'passport-country': {
        'UK/Ireland/Australia/NewZealand/US/Canada/SouthAfrica': 2,
        'Other (where English is the official language)': 1,
        'Other (non-native English speaking Country)': 0
      },
      'tefl-experience': {
        'Over 2 years': 2,
        '1-2 years': 1,
        'Under 1 year': 0
      }
    };

    let total = 0;
    Object.keys(scoring).forEach(field => {
      const value = formData[field];
      if (value && scoring[field][value] !== undefined) {
        total += scoring[field][value];
      }
    });

    return total;
  }

  // Generate fallback HTML for lower quality or error results
  function generateFallbackResultHtml(score) {
    let salaryRange, message1, message2;

    if (score <= 3) {
      salaryRange = '€5-€8 per hour';
      message1 = 'Teaching online is a great way to make extra cash! However, you may want to think about upskilling first.';
      message2 = 'With experience, it will get better!';
    } else if (score <= 6) {
      salaryRange = '€9-€14 per hour';
      message1 = 'Teaching English online could be your dream career.';
      message2 = 'Make sure you have everything needed to earn that bit more!';
    } else {
      salaryRange = '€18-€25 per hour';
      message1 = "Great news! You're on the higher end of the pay scale.";
      message2 = 'Your teaching experience will stand to you!';
    }

    return `
      <div class="salary-result-content fallback-result-content">
        <h2 class="result-title">Your Estimated Earning Potential</h2>
        <div class="salary-highlight">${salaryRange}</div>
        <p>${message1}</p>
        <p>${message2}</p>
        <section class="disclaimer-section">
          <p class="disclaimer-text">
            * Please note that this calculator provides a rough estimate and individual results may vary.
          </p>
        </section>
      </div>
    `;
  }

});
