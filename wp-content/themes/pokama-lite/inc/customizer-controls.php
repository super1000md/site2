<?php

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'pokama_lite_Message_Control' )):
class pokama_lite_Message_Control extends WP_Customize_Control {
    public $settings = 'blogname';
    public $description = '';
    public $label = '';
    public $group = '';
    public $type = '';
    public $list = array();
    public $button = array();
    /**
     * Render the description and title for the sections
     */
    public function render_content() {
        switch ( $this->type ) {
            default:
            case 'list':
                echo '<div class="customizer-mc-list">';
                if ( is_array( $this->list ) && ! empty( $this->list ) ) {
                    echo '<ul class="customizer-mc-ul">';
                    foreach ( $this->list as $l ) {
                        echo '<li>' . wp_kses_post( $l ) . '</li>';
                    }
                    echo '</ul>';
                }
                if ( !empty( $this->button ) ) {
                    echo '<a href="'.esc_url( $this->button['link'] ).'" target="_blank" class="customizer-mc-btn">'.esc_html( $this->button['label'] ).'</a>';
                }
                echo '</div>';
                break;
        }
    }
}
endif;

class Pokama_Customize_Pro_Control extends WP_Customize_Control {
    public $type = 'pokama_pro';
    function render_content(){
        if ( ! empty( $this->label ) ) : ?>
            <span class="customize-control-title pokama-pro-title"><?php echo esc_html( $this->label ); ?></span>
        <?php endif;
        if ( ! empty( $this->description ) ) : ?>
            <div class="description customize-control-description pokama-pro-description"><?php echo $this->description ; ?></div>
        <?php endif; ?>
        <?php

    }
}


?>