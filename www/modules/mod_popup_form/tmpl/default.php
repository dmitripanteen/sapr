<div id="<?= $moduleId; ?>" class="popup popup-module">
    <i class="ti ti-close close-btn"></i>
    <div class="inner">
        <div class="form">
            <form action=""
                  class="form-inline"
                  id="user-support-form"
                  enctype="multipart/form-data"
            >
                <p class="form-header"><?=JText::_('MOD_POPUP_FORM_NEED_HELP_LABEL');?></p>
                <div class="error-msg">
                    <?= JText::_('MOD_POPUP_FORM_SUCCESS_MSG_LABEL'); ?>
                </div>
                <div class="form-body">
                    <div class="row row-input">
                        <label for="company_name">
                            <?= JText::_('MOD_POPUP_FORM_FIELD_COMPANY_NAME_LABEL'); ?>
                        </label>
                        <input
                                type="text"
                                class="form-control"
                                name="jform[company_name]"
                                id="company_name"
                                placeholder=""
                        />
                    </div>
                    <div class="row row-input">
                        <label for="phone">
                            <?= JText::_('MOD_POPUP_FORM_FIELD_PHONE_LABEL'); ?>
                        </label>
                        <input
                                type="text"
                                class="form-control"
                                name="jform[phone]"
                                id="phone"
                                placeholder=""
                        />
                    </div>
                    <div class="row row-input">
                        <label for="email">
                            <?= JText::_('MOD_POPUP_FORM_FIELD_EMAIL_LABEL'); ?>
                        </label>
                        <input
                                type="email"
                                class="form-control"
                                name="jform[email]"
                                id="email"
                                placeholder=""
                        />
                    </div>
                    <div class="row row-input">
                        <label for="message">
                            <?= JText::_('MOD_POPUP_FORM_FIELD_MESSAGE_LABEL'); ?>
                        </label>
                        <textarea
                                class="form-control"
                                name="jform[message]"
                                id="message"
                                rows="5"
                                placeholder=""
                        ></textarea>
                    </div>
                    <div class="files">
                        <div class="file_upload_container">
                            <input type="file"
                                   id="file1"
                                   name="jform[file1]"
                                   hidden
                                   accept="image/*,.log,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                            />
                            <label for="file1" id="file1-label">
                                <i class="ti ti-image"></i>
                            </label>
                            <span id="file-chosen1" class="filename"></span>
                        </div>
                        <div class="file_upload_container">
                            <input type="file"
                                   id="file2"
                                   name="jform[file2]"
                                   hidden
                                   accept="image/*,.log,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                            />
                            <label for="file2" id="file2-label">
                                <i class="ti ti-image"></i>
                            </label>
                            <span id="file-chosen2" class="filename"></span>
                        </div>
                        <div class="file_upload_container">
                            <input type="file"
                                   id="file3"
                                   name="jform[file3]"
                                   hidden
                                   accept="image/*,.log,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                            />
                            <label for="file3" id="file3-label">
                                <i class="ti ti-image"></i>
                            </label>
                            <span id="file-chosen3" class="filename"></span>
                        </div>
                        <div class="file_upload_container">
                            <input type="file"
                                   id="file4"
                                   name="jform[file4]"
                                   hidden
                                   accept="image/*,.log,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                            />
                            <label for="file4" id="file4-label">
                                <i class="ti ti-image"></i>
                            </label>
                            <span id="file-chosen4" class="filename"></span>
                        </div>
                    </div>
                </div>
                <p class="required-label">
                    <?= JText::_('MOD_POPUP_FORM_REQUIRED_FIELD_LABEL'); ?>
                </p>
                <div class="row form-footer">
                    <button type="submit"
                            class="btn btn-default rounded request-complete"
                    >
                        <?= JText::_('MOD_POPUP_FORM_SEND_BUTTON_LABEL'); ?>
                    </button>
                </div>
                <input type="hidden" name="option" value="com_form" />
                <input type="hidden" name="task" value="support.sendRequest" />
            </form>
            <?php echo JHtml::_('form.token'); ?>
            <div class="success-msg">
                <?= JText::_('MOD_POPUP_FORM_SUCCESS_MSG_LABEL'); ?>
            </div>
        </div>
    </div>
</div>


