  <section id="faq" class="faqs-section faqs-section-redesigned ptb-50">
        <?php
            $frequently_asked_questions = get_cfvalue_by_country('frequently_asked_questions');
        ?>
        <div class="ast-container">
            <div class="ast-row">
                <div class="ast-col-md-12 faqs">
                    <h3 class="large-heading faqs-heading common-section-heading text-center">
                        faqs
                    </h3>
                    <div class="faqs-wrapper equal-height">
                        <div class="faqs-accordion">
                            <?php
                            foreach ($frequently_asked_questions as $key => $faq) :
                                $faq_answer = $faq['answer'];
                                $faq_question = $faq['question'];
                            ?>
                                <div class="faqs-accordion__item <?php echo $key === 0 ? 'active' : '' ?>">
                                    <input type="radio" id="acc-<?php echo $key ?>" name="faq-accordion" <?php echo $key === 0 ? 'checked' : '' ?> hidden>
                                    <label class="font-700" for="acc-<?php echo $key ?>">
                                        <span><?php echo $faq_question ?></span>
                                        <i class="fa fa-plus"></i>
                                    </label>
                                    <div class="font-400 faqs-accordion__content <?php echo $key === 0 ? 'active' : '' ?>">
                                        <?php echo $faq_answer ?>
                                    </div>
                                </div>
                            <?php
                            endforeach
                            ?>

                        </div>
                        <div class="show-more-faqs">
                            <span>Show More Faqs</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>