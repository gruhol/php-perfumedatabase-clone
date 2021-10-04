<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function get_score_star($score) {
    if ($score >= 0 && $score < 0.5) {
        $star = '<i class="far fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        return $star;
    } 
    elseif ($score >= 0.5 && $score < 1) {
        $star = '<i class="fas fa-star-half-alt"></i>';
        $star .= '<i class="far fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        return $star;
    } 
    elseif ($score >= 1 && $score < 1.5) {
        $star = '<i class="fas fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        return $star;
    } 
    elseif ($score >= 1.5 && $score < 2) {
        $star = '<i class="fas fa-star"></i> ';
        $star .= '<i class="fas fa-star-half-alt"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        return $star;
    } 
    elseif ($score >= 2 && $score < 2.5) {
        $star = '<i class="fas fa-star"></i> ';
        $star .= '<i class="fas fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        return $star;
    } 
    elseif ($score >= 2.5 && $score < 3) {
        $star = '<i class="fas fa-star"></i> ';
        $star .= '<i class="fas fa-star"></i> ' ;
        $star .= '<i class="fas fa-star-half-alt"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        return $star;
    } 
    elseif ($score >= 3 && $score < 3.5) {
        $star = '<i class="fas fa-star"></i> ';
        $star .= '<i class="fas fa-star"></i> ';
        $star .= '<i class="fas fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        return $star;
    } 
    elseif ($score >= 3.5 && $score < 4) {
        $star = '<i class="fas fa-star"></i> ';
        $star .= '<i class="fas fa-star"></i> ';
        $star .= '<i class="fas fa-star"></i> ';
        $star .= '<i class="fas fa-star-half-alt"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        return $star;
    } 
    elseif ($score >= 4 && $score < 4.5) {
        $star = '<i class="fas fa-star"></i> ';
        $star .= '<i class="fas fa-star"></i> ';
        $star .= '<i class="fas fa-star"></i> ';
        $star .= '<i class="fas fa-star"></i> ';
        $star .= '<i class="far fa-star"></i> ';
        return $star;
    } 
    elseif ($score >= 4.5 && $score == 5) {
        $star = '<i class="fas fa-star"></i> ';
        $star .= '<i class="fas fa-star"></i> ';
        $star .= '<i class="fas fa-star"></i> ';
        $star .= '<i class="fas fa-star"></i> ';
        $star .= '<i class="fas fa-star"></i>';
        return $star;
    }
}

?>
<div class="row">
	<div class="col-md-12">
            <h2><?php echo $this->lang->line('database_reviews: '); ?></h2>
            <?php
            if (!$reviewsdata === FALSE) {
                foreach ($reviewsdata as $row) {
                    echo '<div class="card mt-3">';
                    echo '<p class="card-header">'.$row->login.' - ';
                    
                    //echo '<p><span class="lead"><strong>'.$row->login.'</strong></span> - ';
                    echo $this->lang->line('database_user_review');
                    echo get_score_star($row->score).'</p>';
                    echo '<div class="card-body">';
                    echo '<p>'.$row->textreview.'</p>';
                    echo '<p>'.$row->data_review.'</p>';
                    echo '</div></div>';
                }
            } else {
                echo $this->lang->line('database_no_comments');
            }
            ?>
            </div>
        </div>
    </div>
</div>
