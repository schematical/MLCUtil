<?php
/* 
 * Carries all core enumerated class for MLC
 */
abstract class MLCFlashEmbedParamName{
    const allowScriptAccess = "allowScriptAccess";
    const movie = 'movie';
    const quality = 'quality';
    const bgcolor = 'bgcolor';
    const flashVars = 'flashVars';
}
abstract class MLCFlashEmbedScriptAccess{
    const sameDomain = 'sameDomain';
    const always = 'always';
    const never = 'never';
}
?>