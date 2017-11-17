<?php

class pluginPiwikAnalytics extends Plugin {

        public function init()
        {
                $this->dbFields = array(
                        'piwik-fqdn'=>'',
                        'site-id'=>''
                );
        }

        public function form()
        {
                global $Language;

                $html  = '<div>';
                $html .= '<label for="jspiwik-fqdn">'.$Language->get('Piwik Server FQDN').'</label>';
                $html .= '<input id="jspiwik-fqdn" type="text" name="piwik-fqdn" value="'.$this->getDbField('piwik-fqdn').'">';
                $html .= '<div class="tip">'.$Language->get('complete-this-field-with-the-piwik-server-fqdn').'</div>';
                $html .= '</div>';

                $html .= '<div>';
                $html .= '<label for="jssite-id">'.$Language->get('Piwik Site ID').'</label>';
                $html .= '<input id="jssite-id" type="text" name="site-id" value="'.$this->getDbField('site-id').'">';
                $html .= '<div class="tip">'.$Language->get('complete-this-field-with-the-piwik-site-id').'</div>';
                $html .= '</div>';

                return $html;
        }

        public function siteHead()
        {

                $html = PHP_EOL.'<!-- Piwik Analytics -->'.PHP_EOL;
                $html .= '<script type="text/javascript">'.PHP_EOL;
                $html .= 'var _paq = _paq || [];'.PHP_EOL;
                $html .= '_paq.push([\'trackPageView\']);'.PHP_EOL;
                $html .= '_paq.push([\'enableLinkTracking\']);'.PHP_EOL;
                $html .= '(function() {'.PHP_EOL;
                $html .= '  var u="//'.htmlentities($this->getDbField('piwik-fqdn')).'/";'.PHP_EOL;
                $html .= '  _paq.push([\'setTrackerUrl\', u+\'piwik.php\']);'.PHP_EOL;
                $html .= '  _paq.push([\'setSiteId\', \''.htmlentities($this->getDbField('site-id')).'\']);'.PHP_EOL;
                $html .= '  var d=document, g=d.createElement(\'script\'), s=d.getElementsByTagName(\'script\')[0];'.PHP_EOL; 
                $html .= '  g.type=\'text/javascript\'; g.async=true; g.defer=true; g.src=u+\'piwik.js\'; s.parentNode.insertBefore(g,s);'.PHP_EOL;
		$html .= '})();'.PHP_EOL.'</script>'.PHP_EOL;
                $html .= '<!-- End Piwik Code -->'.PHP_EOL;
                return $html;
        }
}

