<?php
add_action('wpcf7_mail_sent', 'custom_wpcf7_mail_sent');

function custom_wpcf7_mail_sent($contact_form) {
    $id = $contact_form->id;

    if ($id == '73457') {
        $submission = WPCF7_Submission::get_instance();
        if ($submission) {
            $data = $submission->get_posted_data(); 
        }


        $email  = $data['your-email'];
        $score  = $data['quiz-score'];
        $f_name = $data['first-name'];
        $l_name = $data['last-name'];   
        $phone =  $data['phoneNumber'];
        $country = $data['country'];
        if ($score >= 8) {
            $body = "
            <h3>Dear $f_name $l_name,</h3>
            <p>Thank you for taking the quiz. Based on your score of $score/11, we recommend the following:</p>
            <ul style='margin:0'>
              <li>You have excellent English language abilities, which is why we believe the best course for your core TEFL training is our government-regulated <a href='https://teflinstitute.com/course/ofqual-level-5-tefl-course-government-regulated/'>180 Hour Level 5 TEFL Diploma</a></li>
              <li>If you want to earn the best salary then upgrade your training and be the best that you can be with our <a href='https://teflinstitute.com/course/tefl-diploma-ofqual-government-regulated-tefl-institute/'> 300 Hour Level 5 TEFL Diploma.</a></li>
              <li>Enroll in our new <a href='https://teflinstitute.com/course/310-hour-level-5-hybrid-tefl-course/'>310 Hour Hybrid Level 5 TEFL Diploma</a> that includes teaching practice done via our virtual classroom! This is the most comprehensive government-regulated TEFL course on the market. By completing all modules within our 310-hour TEFL Course you will stand out in your future career as a TEFL teacher.</li>
            </ul>
            <p>Now is the time to take the course and plan a career change to get the job of your dreams. Our courses are self-study, meaning you can get it done as quickly as you like with 24/7 access to your online course. You can now request a <a href='https://teflinstitute.com/callback/'> free callback</a> to chat with one of our course enrolment advisors.</p>
            ";
          } else if ($score <= 7 && $score >= 5) {
            $body = "
            <h3>Dear $f_name $l_name,</h3>
            <p>Thank you for taking the quiz. Based on your score of $score/11, we recommend the following:</p>
            <ul style='margin:0'>
              <li>You have a good level of English language. We believe the best course for your primary TEFL training is <a href='https://teflinstitute.com/course/120-hour-advanced-tefl-course/'> 120 Hour Advanced TEFL Course</a></li>
              <li>Upgrade your training and be the best that you can be with <a href='https://teflinstitute.com/course/240-hour-master-tefl-course/'>our 240 Hour Master TEFL Course</a></li>
            </ul>
            <p>Now is the time to take the course and plan a career change to get the job of your dreams. Our courses are self-study, meaning you can get it done as quickly as you like with 24/7 access to your online course. You can now request a <a href='https://teflinstitute.com/callback/'> free callback</a> to chat with one of our course enrolment advisors.</p>
            ";
          } else {
            $body = "
            <h3>Dear $f_name $l_name,</h3>
            <p>Thank you for taking the quiz. Based on your score of $score/11, we recommend the following:</p>
            <ul style='margin:0'>
              <li>Boost your English level by finding ways to use your English skills, such as in social groups, through work, music or Netflix shows in English. In no time you’ll feel confident to enroll on the <a href='https://teflinstitute.com/course/120-hour-advanced-tefl-course/'> 120 Hour Advanced TEFL Course</a>, from our accredited fast-track range.</li>
            </ul>
            <p>Now is the time to take the course and plan a career change to get the job of your dreams. Our courses are self-study, meaning you can get it done as quickly as you like with 24/7 access to your online course. You can now request a <a href='https://teflinstitute.com/callback/'> free callback</a> to chat with one of our course enrolment advisors.</p>
            ";
          }

        //body for admin
        if ($score >= 8) {
            $admin_body = "
            <h3>Recommended courses based on quiz score</h3>
            <p>Name: $f_name $l_name</p>
            <p>Email: $email</p>
            <p>Quiz Score: $score/11</p>
            <p>Phone: $phone</p>
            <p>Country: $country[0]</p>
            <ul style='margin:0'>
              <li><a href='https://teflinstitute.com/course/ofqual-level-5-tefl-course-government-regulated/'>180 Hour Level 5 TEFL Diploma</a></li>
              <li><a href='https://teflinstitute.com/course/tefl-diploma-ofqual-government-regulated-tefl-institute/'> 300 Hour Level 5 TEFL Diploma.</a></li>
              <li><a href='https://teflinstitute.com/course/310-hour-level-5-hybrid-tefl-course/'>310 Hour Hybrid Level 5 TEFL Diploma</a></li>
            </ul>
            ";
          } else if ($score <= 7 && $score >= 5) {
            $admin_body = "
            <h3>Recommended courses based on quiz score</h3>
            <p>Name: $f_name $l_name</p>
            <p>Email: $email</p>
            <p>Quiz Score: $score/11</p>
            <p>Phone: $phone</p>
            <p>Country: $country[0]</p>
            <ul style='margin:0'>
              <li><a href='https://teflinstitute.com/course/120-hour-advanced-tefl-course/'> 120 Hour Advanced TEFL Course</a></li>
              <li><a href='https://teflinstitute.com/course/240-hour-master-tefl-course/'>our 240 Hour Master TEFL Course</a></li>
            </ul>
            ";
          } else {
            $admin_body = "
            <h3>Recommended courses based on quiz score</h3>
            <p>Name: $f_name $l_name</p>
            <p>Email: $email</p>
            <p>Quiz Score: $score/11</p>
            <p>Phone: $phone</p>
            <p>Country: $country[0]</p>
            
            <ul style='margin:0'>
              <li><a href='https://teflinstitute.com/course/120-hour-advanced-tefl-course/'> 120 Hour Advanced TEFL Course</a></li>
            </ul>
            ";
          }
        
        // Set up the email variables
        $subject = 'Courses recommendation based on your quiz score';

        $headers = array('Content-Type: text/html; charset=UTF-8');

        // Send the email to the user
        // wp_mail($email, $subject, $body, $headers);
        wp_mail(get_option('admin_email'), "TEFL Institute English Level Test: Course recommendation for $f_name $l_name", $admin_body, $headers);
    }
}