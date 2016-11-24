<div class="mkd-tabs-content">
    <div class="tab-content">
        <div class="tab-pane fade in active" id="import">
            <div class="mkd-tab-content">
                <div class="mkd-page-title-holder clearfix">
                    <h2 class="mkd-page-title"><?php esc_html_e('Import', 'newshub'); ?></h2>
                </div>
                <form method="post" class="mkd_ajax_form mkd-import-page-holder">
                    <div class="mkd-page-form">
                        <div class="mkd-page-form-section-holder">
                            <h3 class="mkd-page-section-title"><?php esc_html_e('Import Demo Content', 'newshub'); ?>t</h3>
                            <div class="mkd-page-form-section">
                                <div class="mkd-field-desc">
                                    <h4><?php esc_html_e('Import', 'newshub'); ?></h4>

                                    <p><?php esc_html_e('Choose demo content you want to import', 'newshub'); ?></p>
                                </div>
                                <!-- close div.mkd-field-desc -->

                                <div class="mkd-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <select name="import_example" id="import_example" class="form-control mkd-form-element dependence">
                                                    <option value="newshub1"><?php esc_html_e('Newshub 1 - Business Hub', 'newshub')?></option>
                                                    <option value="newshub2"><?php esc_html_e('Newshub 2 - Fashion Hub', 'newshub')?></option>
                                                    <option value="newshub3"><?php esc_html_e('Newshub 3 - Food Hub', 'newshub')?></option>
                                                    <option value="newshub4"><?php esc_html_e('Newshub 4 - Lifestyle Hub', 'newshub')?></option>
                                                    <option value="newshub5"><?php esc_html_e('Newshub 5 - Music Hub', 'newshub')?></option>
                                                    <option value="newshub6"><?php esc_html_e('Newshub 6 - Sports Hub', 'newshub')?></option>
                                                    <option value="newshub7"><?php esc_html_e('Newshub 7 - Tech Hub', 'newshub')?></option>
                                                    <option value="newshub8"><?php esc_html_e('Newshub 8 - Travel Hub', 'newshub')?></option>
                                                    <option value="newshub9"><?php esc_html_e('Newshub 9 - Gaming Hub', 'newshub')?></option>
                                                    <option value="newshub10"><?php esc_html_e('Newshub 10 - Crafts Hub', 'newshub')?></option>
                                                    <option value="newshub11"><?php esc_html_e('Newshub 11 - Beauty Hub', 'newshub')?></option>
                                                    <option value="newshub12"><?php esc_html_e('Newshub 12 - Art Hub', 'newshub')?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- close div.mkd-section-content -->

                            </div>

                            <div class="mkd-page-form-section">


                                <div class="mkd-field-desc">
                                    <h4><?php esc_html_e('Import Type', 'newshub'); ?></h4>

                                    <p><?php esc_html_e('Enabling this option will switch to a Side Position (default is Top Position)', 'newshub'); ?></p>
                                </div>
                                <!-- close div.mkd-field-desc -->


                                <div class="mkd-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <select name="import_option" id="import_option" class="form-control mkd-form-element">
                                                    <option value=""><?php esc_html_e('Please Select', 'newshub'); ?></option>
                                                    <option value="complete_content"><?php esc_html_e('All', 'newshub'); ?></option>
                                                    <option value="content"><?php esc_html_e('Content', 'newshub'); ?></option>
                                                    <option value="widgets"><?php esc_html_e('Widgets', 'newshub'); ?></option>
                                                    <option value="options"><?php esc_html_e('Options', 'newshub'); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- close div.mkd-section-content -->

                            </div>
                            <div class="mkd-page-form-section">


                                <div class="mkd-field-desc">
                                    <h4><?php esc_html_e('Import attachments', 'newshub'); ?></h4>

                                    <p><?php esc_html_e('Do you want to import media files?', 'newshub'); ?></p>
                                </div>
                                <!-- close div.mkd-field-desc -->
                                <div class="mkd-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <p class="field switch">
                                                    <label class="cb-enable dependence"><span><?php esc_html_e('Yes', 'newshub'); ?></span></label>
                                                    <label class="cb-disable selected dependence"><span><?php esc_html_e('No', 'newshub'); ?></span></label>
                                                    <input type="checkbox" id="import_attachments" class="checkbox" name="import_attachments" value="1">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- close div.mkd-section-content -->
                            </div>
                            <div class="mkd-page-form-section">


                                <div class="mkd-field-desc">
                                    <input type="submit" class="btn btn-primary btn-sm " value="Import" name="import" id="import_demo_data" />
                                </div>
                                <!-- close div.mkd-field-desc -->
                                <div class="mkd-section-content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="import_load"><span><?php esc_html_e('The import process may take some time. Please be patient.', 'newshub') ?> </span><br />
                                                    <div class="mkd-progress-bar-wrapper html5-progress-bar">
                                                        <div class="progress-bar-wrapper">
                                                            <progress id="progressbar" value="0" max="100"></progress>
                                                        </div>
                                                        <div class="progress-value">0%</div>
                                                        <div class="progress-bar-message">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- close div.mkd-section-content -->
                            </div>
                            <div class="mkd-page-form-section mkd-import-button-wrapper">

                                <div class="alert alert-warning">
                                    <strong><?php esc_html_e('Important notes:', 'newshub') ?></strong>
                                    <ul>
                                        <li><?php esc_html_e('Please note that import process will take time needed to download all attachments from demo web site.', 'newshub'); ?></li>
                                        <li> <?php esc_html_e('If you plan to use shop, please install WooCommerce before you run import.', 'newshub')?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>

            </div><!-- close mkd-tab-content -->
        </div>
    </div>
</div> <!-- close div.mkd-tabs-content -->

<script type="text/javascript">
    (function($) {
        $(document).ready(function() {
            $(document).on('click', '#import_demo_data', function(e) {
                e.preventDefault();
                if (confirm('Are you sure, you want to import Demo Data now?')) {
                    $('.import_load').css('display','block');
                    var progressbar = $('#progressbar');
                    var import_opt = $( "#import_option" ).val();
                    var import_expl = $( "#import_example" ).val();
                    var p = 0;
                    if(import_opt == 'content'){
                        for(var i=1;i<10;i++){
                            var str;
                            if (i < 10) str = 'newshub_content_0'+i+'.xml';
                            else str = 'newshub_content_'+i+'.xml';
                            jQuery.ajax({
                                type: 'POST',
                                url: ajaxurl,
                                data: {
                                    action: 'mkd_dataImport',
                                    xml: str,
                                    example: import_expl,
                                    import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
                                },
                                success: function(data, textStatus, XMLHttpRequest){
                                    p+= 10;
                                    $('.progress-value').html((p) + '%');
                                    progressbar.val(p);
                                    if (p == 90) {
                                        str = 'newshub_content_10.xml';
                                        jQuery.ajax({
                                            type: 'POST',
                                            url: ajaxurl,
                                            data: {
                                                action: 'mkd_dataImport',
                                                xml: str,
                                                example: import_expl,
                                                import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
                                            },
                                            success: function(data, textStatus, XMLHttpRequest){
                                                p+= 10;
                                                $('.progress-value').html((p) + '%');
                                                progressbar.val(p);
                                                $('.progress-bar-message').html('<div class="alert alert-success"><strong><?php esc_html_e('Import is completed', 'newshub') ?></strong></div>');
                                            },
                                            error: function(MLHttpRequest, textStatus, errorThrown){
                                            }
                                        });
                                    }
                                },
                                error: function(MLHttpRequest, textStatus, errorThrown){
                                }
                            });
                        }
                    } else if(import_opt == 'widgets') {
                        jQuery.ajax({
                            type: 'POST',
                            url: ajaxurl,
                            data: {
                                action: 'mkd_widgetsImport',
                                example: import_expl
                            },
                            success: function(data, textStatus, XMLHttpRequest){
                                $('.progress-value').html((100) + '%');
                                progressbar.val(100);
                            },
                            error: function(MLHttpRequest, textStatus, errorThrown){
                            }
                        });
                        $('.progress-bar-message').html('<div class="alert alert-success"><strong><?php esc_html_e('Import is completed','newshub') ?></strong></div>');
                    } else if(import_opt == 'options'){
                        jQuery.ajax({
                            type: 'POST',
                            url: ajaxurl,
                            data: {
                                action: 'mkd_optionsImport',
                                example: import_expl
                            },
                            success: function(data, textStatus, XMLHttpRequest){
                                $('.progress-value').html((100) + '%');
                                progressbar.val(100);
                            },
                            error: function(MLHttpRequest, textStatus, errorThrown){
                            }
                        });
                        $('.progress-bar-message').html('<div class="alert alert-success"><strong><?php esc_html_e('Import is completed.', 'newshub') ?></strong></div>');
                    }else if(import_opt == 'complete_content'){
                        for(var i=1;i<10;i++){
                            var str;
                            if (i < 10) str = 'newshub_content_0'+i+'.xml';
                            else str = 'newshub_content_'+i+'.xml';
                            jQuery.ajax({
                                type: 'POST',
                                url: ajaxurl,
                                data: {
                                    action: 'mkd_dataImport',
                                    xml: str,
                                    example: import_expl,
                                    import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
                                },
                                success: function(data, textStatus, XMLHttpRequest){
                                    p+= 10;
                                    $('.progress-value').html((p) + '%');
                                    progressbar.val(p);
                                    if (p == 90) {
                                        str = 'newshub_content_10.xml';
                                        jQuery.ajax({
                                            type: 'POST',
                                            url: ajaxurl,
                                            data: {
                                                action: 'mkd_dataImport',
                                                xml: str,
                                                example: import_expl,
                                                import_attachments: ($("#import_attachments").is(':checked') ? 1 : 0)
                                            },
                                            success: function(data, textStatus, XMLHttpRequest){
                                                jQuery.ajax({
                                                    type: 'POST',
                                                    url: ajaxurl,
                                                    data: {
                                                        action: 'mkd_otherImport',
                                                        example: import_expl
                                                    },
                                                    success: function(data, textStatus, XMLHttpRequest){
                                                        //alert(data);
                                                        $('.progress-value').html((100) + '%');
                                                        progressbar.val(100);
                                                        $('.progress-bar-message').html('<div class="alert alert-success"><?php esc_html_e('Import is completed.', 'newshub') ?></div>');
                                                    },
                                                    error: function(MLHttpRequest, textStatus, errorThrown){
                                                    }
                                                });
                                            },
                                            error: function(MLHttpRequest, textStatus, errorThrown){
                                            }
                                        });
                                    }
                                },
                                error: function(MLHttpRequest, textStatus, errorThrown){
                                }
                            });
                        }
                    }
                }
                return false;
            });
        });
    })(jQuery);

</script>