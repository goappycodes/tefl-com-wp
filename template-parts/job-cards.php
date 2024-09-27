<?php 
    foreach($jobs as $job):
        $job_type = $job['job_type'];
        $job_logo = $job['job_company_logo'];
        $job_link = $job['job_link'];
        $job_requirements = $job['job_requirements'];
        $job_pay = $job['job_salary'];
        $job_hours = $job['job_hours'];
    ?>
        <div class="ast-col-md-4">
        <a target="_blank" href="<?php echo $job_link; ?>" class="job-clickbox"></a>
            <div class="job-card">
                <div class="job-card__header">
                    <div class="job-type">
                        <?php echo $job_type; ?>
                    </div>
                    <div class="job-image">
                        <img src="<?php echo $job_logo; ?>">
                    </div>
                </div>
                <div class="job-card__body">
                    <div class="job-card__body-content">
                        <div class="job-requirements">
                            <span>Requirements: </span>
                            <?php echo $job_requirements?>
                        </div>
                        <div class="job-pay">
                            <span>Pay: </span>
                            <?php echo $job_pay?>
                        </div>
                        <div class="job-hours">
                            <span>Hours: </span>
                            <?php echo $job_hours?>
                        </div>
                    </div>
                    <div class="job-card__body-cta">
                    <a target="_blank" href="<?php echo $job_link; ?>" class="learn-more black-button"><span>learn more</span></a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach?>