<?php
    /**
     * TwitterLink: Link to Twitter user page with {@twitterID}.
     *
     * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
     * @author     mecab <mecab.jp[at]gmail.com>
     */
     
    // must be run within Dokuwiki
    if(!defined('DOKU_INC')) die();
     
    if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
    require_once(DOKU_PLUGIN.'syntax.php');
     
    /**
     * All DokuWiki plugins to extend the parser/rendering mechanism
     * need to inherit from this class
     */
    class syntax_plugin_twitter_link extends DokuWiki_Syntax_Plugin {
     
        function getInfo(){
            return array(
                'author' => 'mecab',
                'email'  => 'mecab.jp[at]gmail.com',
                'date'   => '2010-02-26',
                'name'   => 'Twitter Link',
                'desc'   => 'Link to Twitter user page with {@twitterID}',
                'url'    => 'http://mecab.mine.nu/dokuwiki/',
                );
        }
     
        function getType() { return 'formatting'; }
        function getSort() { return 256; }
     
        function connectTo($mode) {
            $this->Lexer->addSpecialPattern('\{@\w+\}',$mode,'plugin_twitter_link');
        }
     
        function handle($match, $state, $pos, &$handler){
    	$id = substr($match, 2, strlen($id)-1);
            $addr = 'http://twitter.com/'.$id;
            return array($state, array($id, $addr));
        }
     
        function render($mode, &$renderer, $data) {
            if($mode == 'xhtml'){
                list ($state, $ary) = $data;
                list($id, $addr) = $ary;
     
                $renderer->doc .= "<a href=\"{$addr}\" class=\"twitter-link-plugin\" title=\"Twitter/{$id}\">@{$id}</a>";
     
                return true;
            }
            return false;
        }
    }
?>
