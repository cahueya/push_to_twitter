<?php 


defined('C5_EXECUTE') or die("Access Denied.");
$form = $ih = Core::make('helper/form');
$ci = Loader::helper('concrete/ui');
$twitterurl = '<a href="https://apps.twitter.com" target="_blank">https://apps.twitter.com</a>';
?>



<div class="container">
    <form method="post" action="<?= $view->action('update_configuration')?>">

        <?php
        /** @var $token \Concrete\Core\Validation\CSRF\Token */
        echo $token->output('perform_update_configuration');

        ?>

        <div class="row">    
            <fieldset>
                <div class="col-xs-12 col-md-12">     
                    <legend><?php echo t('Subscription Data'); ?>
                        <span id="helpBlock" class="help-block"><?php echo t(
                            'You need to apply for a developer account at 
                            %s 
                            to get the access keys.', $twitterurl); ?></span>
                    </legend>  
                </div>


                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="consumerKey"><?php echo t('Consumer Key'); ?></label>
                            <?php echo $form->text('consumerKey', $consumerKey, array('class' => 'span2', 'placeholder'=>t('Consumer Key')))?>
                        </div>
                    </div>
    
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="consumerSecret"><?php echo t('Consumer Secret'); ?></label>
                            <?php echo $form->text('consumerSecret', $consumerSecret, array('class' => 'span2', 'placeholder'=>t('Consumer Secret')))?>
                        </div>
                    </div>
    

                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="accessToken"><?php echo t('Access Token'); ?></label>
                            <?php echo $form->text('accessToken', $accessToken, array('class' => 'span2', 'placeholder'=>t('Access Token')))?>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label for="accessTokenSecret"><?php echo t('Access Token Secret'); ?></label>
                            <?php echo $form->text('accessTokenSecret', $accessTokenSecret, array('class' => 'span2', 'placeholder'=>t('Access Token Secret')))?>
                        </div>
                    </div>

                    <div class="col-xs-12 col-md-12">
                        <div class="form-group">
                            <label for="messageString"><?php echo t('Message'); ?></label>
                            <?php echo $form->text('messageString', $messageString, array('maxlength' => '100', 'class' => 'span2', 'placeholder'=>t('Message')))?>
                            <span id="helpBlock" class="help-block"><?php echo t('Insert a text with maximum 10 characters to prefix your posted URL.'); ?></span>
                        </div>
                    </div>  
            
            </fieldset>
        </div>
        <div class="ccm-dashboard-form-actions-wrapper">
            <div class="ccm-dashboard-form-actions">
                <button class="pull-right btn btn-success" type="submit" ><?php echo t('Save')?></button>
            </div>
        </div>
    </form>
</div>
