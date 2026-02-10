<?php

/*************************************************
## Post Comment Customization
*************************************************/

if ( ! function_exists( 'agrikon_custom_commentlist' ) ) {
    // Theme custom comment list
    function agrikon_custom_commentlist($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class('nt-comment-item'); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>">
                <div class="nt-comment-left">
                    <div class="nt-comment-avatar">
                        <?php echo get_avatar( $comment, $size='80' ); ?>
                    </div>
                    <?php if ($comment->comment_approved == '0') : ?>
                        <em><?php esc_html_e('Your comment is awaiting moderation.', 'agrikon') ?></em>
                        <br />
                    <?php endif; ?>
                </div>
                <div class="nt-comment-right">
                    <div class="nt-comment-author comment__author-name">
                        <?php echo get_comment_author_link(); ?>
                    </div>
                    <div class="nt-comment-date">
                        <span class="post-meta__item __date-post">
                            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
                                <?php printf(esc_html__('%1$s at %2$s', 'agrikon'), get_comment_date(),  get_comment_time()) ?>
                            </a>
                            <?php edit_comment_link(esc_html__('(Edit)', 'agrikon'),'  ','') ?>
                        </span>
                    </div>
                    <div class="nt-comment-content nt-theme-content nt-clearfix"><?php comment_text() ?></div>
                    <div class="nt-comment-date post-meta">
                        <div class="nt-comment-reply-content post-meta__item"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
                    </div>
                </div>
            </div>
        <?php
    }
}

// Add placeholder for Name and Email
if ( ! function_exists( 'agrikon_move_modify_comment_form_fields' ) ) {
    function agrikon_move_modify_comment_form_fields($fields){

        $commenter     = wp_get_current_commenter();
        $user          = wp_get_current_user();
        $user_identity = $user->exists() ? $user->display_name : '';
        $req           = get_option( 'require_name_email' );
        $aria_req      = ( $req ? " aria-required='true'" : '' );
        $html_req      = ( $req ? " required='required'" : '' );
        $html5         = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : false;
        $consent       = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';

        $fields['author'] = '<div class="contact-one__form"><div class="row"><div class="col-md-4"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" placeholder="' . esc_attr__( 'Enter your name ...', 'agrikon' ) . '"' . $aria_req . ' required /></div>';

        $fields['email'] = '<div class="col-md-4"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . esc_attr__( 'Enter your email ...', 'agrikon' ) . '"' . $aria_req . ' required/></div>';

        $fields['url'] = '<div class="col-md-4"><input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="'.esc_attr__( 'Enter your website ...', 'agrikon'  ).'" required/></div>';

		 $fields['comment'] = '<div class="col-md-12"><textarea id="comment" name="comment" cols="45" rows="6" aria-required="true" placeholder="' . esc_attr__( 'Enter your comment ...', 'agrikon' ) . '"></textarea></div>';

        $fields['cookies'] = '<div class="col-md-12"><div class="wp-comment-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' . '<span>' . esc_attr__( 'Save my name, email, and website in this browser for the next time I comment.', 'agrikon' ) . '</span></div></div></div></div>';

        return $fields;
    }
    add_filter('comment_form_default_fields','agrikon_move_modify_comment_form_fields');
}

// add class comment form button
if ( ! function_exists( 'agrikon_addclass_form_button' ) ) {
    function agrikon_addclass_form_button( $arg ) {
        $arg['class_submit'] = 'thm-btn';
        return $arg;
    }
    // run the comment form defaults through the newly defined filter
    add_filter( 'comment_form_defaults', 'agrikon_addclass_form_button' );
}
