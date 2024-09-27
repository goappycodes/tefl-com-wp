<?php

/**
 * Template Name: Meet The Team
 *
 * @package WordPress
 * @subpackage Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

get_header(); ?>
<!--section heading-->

<?php

$heading = get_field('heading');

$title = $heading['header_title'];
$stitle = $heading['header_subtitle'];


?>
<section class="header-section">

    <div calss="ast-container">
        <div class="ast-row">
            <div class="ast-col-lg-6">
                <h1 class="section-heading"><?php echo $title ?></h1>

                <p><?php echo $stitle ?></p>
            </div>

        </div>
    </div>

</section>

<!--/section heading-->



<!--Team Tabs-->

<section class="meet-the-team-section">
    <div class="ast-container">
        <div class="ast-row">
            <div class="ast-col-lg-12">
                <div class="meet-the-team-tabs">
                    <div class="tabs">
                        <a class="tablinks active" data-tab-target="#mno" href="#mno">management and operations team</a>
                        <a class="tablinks" data-tab-target="#ac" href="#ac">academic team</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!--/Team Tabs-->

<?php

$teams = get_field('teams');

$management = $teams['management_and_operations'];
$council = $teams['academic_council'];

$array_count = sizeof($management);
$array_count2 = sizeof($council);
?>

<!--Team Tab Content-->
<section class="teams-section">
    <div class="management-operations active" data-tab-content id="mno">
        <div class="ast-container">
            <?php
            if ($management) :
                $rowCount = 0;
            ?>
                <div class="ast-row">
                    <?php
                    foreach ($management as $member) :
                        $rowCount++;
                        $image = $member['member_image'];
                        $image_position = $member['member_image_position'];
                        $name = $member['member_name'];
                        $designation = $member['member_designation'];
                        $details = $member['member_details'];
                    ?>

                        <div class="ast-col-lg-4 <?php //if ($rowCount == $array_count and $array_count > 3) {
                                                        //echo 'ast-col-lg-offset-4';
                                                    //} ?> ast-col-md-6 ast-col-sm-12">
                            <div class="team-member <?php //if ($rowCount == $array_count) {
                                                        //echo 'last';
                                                    //} ?>">
                                <div class="team-member-image" style="background-image: url('<?php echo $image ?>'); background-position: <?php echo $image_position ?>;"></div>
                                <h5 class="team-member-name"><?php echo $name ?></h5>
                                <h5 class="team-member-title"><?php echo $designation ?></h5>
                                <p class="team-member-about"><?php echo $details ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif ?>
                </div>
        </div>
    </div>
    <div class="academic-council" data-tab-content id="ac">
        <div class="ast-container">

            <?php
            if ($council) :
                $rowCount = 0;
            ?>

                <div class="ast-row">
                    <?php
                    foreach ($council as $member) :
                        $rowCount++;
                        $image = $member['member_image'];
                        $image_position = $member['member_image_position'];
                        $name = $member['member_name'];
                        $designation = $member['member_designation'];
                        $details = $member['member_details'];
                    ?>

                        <div class="ast-col-lg-4 <?php if ($rowCount == $array_count_2 and $array_count2 > 3) {
                                                        echo 'ast-col-lg-offset-4';
                                                    } ?> ast-col-md-6 ast-col-sm-12">
                            <div class="team-member  <?php if ($array_count2 == 3) {
                                                            echo 'no-border';
                                                        }
                                                        if ($rowCount == $array_count2) {
                                                            echo ' last';
                                                        }
                                                        ?>">

                                <div class="team-member-image" style="background-image: url('<?php echo $image ?>'); background-position: <?php echo $image_position ?>;"></div>
                                <h5 class="team-member-name"><?php echo $name ?></h5>
                                <h5 class="team-member-title"><?php echo $designation ?></h5>
                                <p class="team-member-about"><?php echo $details ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif ?>
                </div>
        </div>


    </div>
</section>
<!--/Team Tab Content-->


<!--Contact us Section-->
<?php
$contact_details = get_field('contact_details');

$heading = $contact_details['heading'];
?>
<section class="contact-section">
    <div class="ast-container">
        <div class="ast-row">
            <div class="ast-col-md-12">
                <h2 class="section-heading"><?php echo $heading ?></h2>
            </div>
        </div>
        <?php $contacts = $contact_details['contact_infos'];
        if ($contacts) :
        ?>
            <div class="ast-row contact-icons">
                <?php foreach ($contacts as $contact) :
                    $icon = $contact['icon'];
                    $title = $contact['title'];
                    $subtitle = $contact['subtitle'];
                    $details = $contact['details'];
                ?>
                    <div class="ast-col-md-3 ast-col-xs-6">
                        <img src="<?php echo $icon ?>">
                        <h3><?php echo $title ?></h3>
                        <p><?php echo $subtitle ?></p>
                        <p><?php echo $details ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif ?>
    </div>
</section>

<!--/Contact us Section-->
<?php get_footer(); ?>