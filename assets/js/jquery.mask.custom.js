jQuery.jMaskGlobals.translation['&'] = {
    pattern: /[a-zA-Zа-яА-ЯİßẞàÀÁáâÂÄäåÅÆæçÇèÈÉéÊêËëÌìíÍÎîÏïñÑÒòÓóÔôöÖøÙùúÚûÛÜüýÝŸÿăĂĄąĆćČčĎďęĘěĞğłŁńŃňŇőŐŒœŘřŚśşŞŠšťŤŮůźŹŻżžŽșȘȚț\- ]/,
    recursive: true
};
jQuery.jMaskGlobals.translation['T'] = {
    pattern: /[a-zA-Zа-яА-Я'\- ]/,
    recursive: true
};
jQuery.jMaskGlobals.translation['P'] = {pattern: /[+() \d\-]/, recursive: true};
jQuery.jMaskGlobals.translation['Z'] = {
    pattern: /[a-zA-Zа-яА-Я0-9\-]/,
    recursive: true
};
jQuery.jMaskGlobals.translation['E'] = {pattern: /[\w@\-.+]/, recursive: true};
jQuery.jMaskGlobals.translation['N'] = {pattern: /[0-9]/, recursive: true};

jQuery.jMaskGlobals.maskElements = 'input,td,span,div,textarea';
