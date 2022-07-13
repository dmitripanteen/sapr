<?php defined('_JEXEC') or die;

if ($this->params['menu-meta_description']) {
    JFactory::getDocument()->setDescription(
        $this->params['menu-meta_description']
    );
}
if ($this->params['menu-meta_keywords']) {
    JFactory::getDocument()->setMetaData(
        'keywords',
        $this->params['menu-meta_keywords']
    );
}
?>
<h1 class="page-header"><?= $this->pageHeading; ?></h1>
<?php if ($this->textBeforeForm): ?>
    <div class="text-before-content">
        <?= $this->textBeforeForm; ?>
    </div>
<?php endif; ?>
<div class="info-message"></div>
<div class="form">
    <form method="post" class="form-inline" id="trial-version-form" role="form">
        <div class="form-body">
            <div class="col">
                <div class="row row-input">
                    <label for="company_name">
                        <?= JText::_('COM_FORM_FIELD_COMPANY_NAME_LABEL'); ?>
                    </label>
                    <input
                            type="text"
                            class="form-control"
                            name="jform[company_name]"
                            id="company_name"
                            placeholder=""
                            value="<?= $this->userState->get(
                                'company_name'
                            ); ?>"
                    />
                </div>
                <div class="row row-input">
                    <label for="address">
                        <?= JText::_('COM_FORM_FIELD_ADDRESS_LABEL'); ?>
                    </label>
                    <input
                            type="text"
                            class="form-control"
                            name="jform[address]"
                            id="address"
                            placeholder=""
                            value="<?= $this->userState->get('address'); ?>"
                    />
                </div>
                <div class="row row-input">
                    <label for="inn">
                        <?= JText::_('COM_FORM_FIELD_INN_LABEL'); ?>
                    </label>
                    <input
                            type="text"
                            class="form-control"
                            name="jform[inn]"
                            id="inn"
                            placeholder=""
                            value="<?= $this->userState->get('inn'); ?>"
                    />
                </div>
            </div>
            <div class="col">
                <div class="row row-input">
                    <label for="contact_person">
                        <?= JText::_('COM_FORM_FIELD_CONTACT_PERSON_LABEL'); ?>
                    </label>
                    <input
                            type="text"
                            class="form-control"
                            name="jform[contact_person]"
                            id="contact_person"
                            placeholder=""
                            value="<?= $this->userState->get(
                                'contact_person'
                            ); ?>"
                    />
                </div>
                <div class="row row-input">
                    <label for="phone">
                        <?= JText::_('COM_FORM_FIELD_PHONE_LABEL'); ?>
                    </label>
                    <input
                            type="text"
                            class="form-control"
                            name="jform[phone]"
                            id="phone"
                            placeholder=""
                            value="<?= $this->userState->get('phone'); ?>"
                    />
                </div>
                <div class="row row-input">
                    <label for="email">
                        <?= JText::_('COM_FORM_FIELD_EMAIL_LABEL'); ?>
                    </label>
                    <input
                            type="text"
                            class="form-control"
                            name="jform[email]"
                            id="email"
                            placeholder=""
                            value="<?= $this->userState->get('email'); ?>"
                    />
                </div>
            </div>
        </div>
        <p class="required-label">
            <?= JText::_('COM_FORM_REQUIRED_FIELD_LABEL'); ?>
        </p>
        <div class="row row-input">
            <div id="captcha" class="g-recaptcha"
                 data-sitekey="<?php echo ReCaptcha::getPublicKey(); ?>"></div>
        </div>
        <div class="row form-footer">
            <button type="submit"
                    class="btn btn-default btn-orange rounded request-complete"
            >
                <?= JText::_('COM_FORM_SEND_BUTTON_LABEL'); ?>
            </button>
        </div>
        <input type="hidden" name="task" value="trialversion.sendRequest"/>
        <?php echo JHtml::_('form.token'); ?>
    </form>
</div>
