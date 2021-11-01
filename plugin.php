<?php

class pluginMatomoAnalytics extends Plugin {

        public function init()
        {
                $this->dbFields = [
                        'matomo-fqdn'   => '',
                        'site-id'       => '',
                        'token'         => ''
                ];
        }

        public function form()
        {
                global $L;

                $html  = '<div>';
                $html .= '<label for="jsmatomo-fqdn">'.$L->get('Matomo Server FQDN').'</label>';
                $html .= '<input id="jsmatomo-fqdn" type="text" name="matomo-fqdn" value="'.$this->getValue('matomo-fqdn').'">';
                $html .= '<div class="tip">'.$L->get('complete-this-field-with-the-matomo-server-fqdn').'</div>';
                $html .= '</div>';

                $html .= '<div>';
                $html .= '<label for="jssite-id">'.$L->get('Matomo Site ID').'</label>';
                $html .= '<input id="jssite-id" type="text" name="site-id" value="'.$this->getValue('site-id').'">';
                $html .= '<div class="tip">'.$L->get('complete-this-field-with-the-matomo-site-id').'</div>';
                $html .= '</div>';

                return $html;
        }

        public function siteHead()
        {

                $html = PHP_EOL.'<!-- Matomo Analytics -->'.PHP_EOL;
                $html .= '<script type="text/javascript">'.PHP_EOL;
                $html .= 'var _paq = _paq || [];'.PHP_EOL;
                $html .= '_paq.push([\'trackPageView\']);'.PHP_EOL;
                $html .= '_paq.push([\'enableLinkTracking\']);'.PHP_EOL;
                $html .= '(function() {'.PHP_EOL;
                $html .= '  var u="//'.htmlentities($this->getValue('matomo-fqdn')).'/";'.PHP_EOL;
                $html .= '  _paq.push([\'setTrackerUrl\', u+\'matomo.php\']);'.PHP_EOL;
                $html .= '  _paq.push([\'setSiteId\', \''.htmlentities($this->getValue('site-id')).'\']);'.PHP_EOL;
                $html .= '  var d=document, g=d.createElement(\'script\'), s=d.getElementsByTagName(\'script\')[0];'.PHP_EOL;
                $html .= '  g.type=\'text/javascript\'; g.async=true; g.defer=true; g.src=u+\'matomo.js\'; s.parentNode.insertBefore(g,s);'.PHP_EOL;
		        $html .= '})();'.PHP_EOL.'</script>'.PHP_EOL;
                $html .= '<!-- End Matomo Code -->'.PHP_EOL;
                return $html;
        }

	    public function siteBodyEnd() 
        {
            $html = [];
            $html[] = '<!-- Matomo Image Tracker-->';
            $html[] = '<noscript><img referrerpolicy="no-referrer-when-downgrade" src="//'.htmlentities($this->getValue('matomo-fqdn')).'/matomo.php?idsite='.htmlentities($this->getValue('site-id')).'&amp;rec=1" style="border:0" alt="" /></noscript>';
            $html[] = '<!-- End Matomo -->';
            return implode(PHP_EOL, $html);
        }
}
