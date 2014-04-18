<?php
include 'init_autoloader.php';

use Sunra\PhpSimple\HtmlDomParser;
use Zend\Cache\StorageFactory;
use Zend\Cache\PatternFactory;

function toJSON($results)
{
    if(!$results) {
        return;
    }
    $callback = isset($_GET['callback']) ? $_GET['callback'] : '';
    $results = json_encode($results);
    $results = $callback ? $callback . '(' . $results . ')' : $results;
    header('Content-Type:application/json');
    echo $results;
}

/*
function getResultsFromSobt($keyword)
{
    $res = \Requests::get('http://so-bt.com/web.php?' . http_build_query(array(
        'q' => $keyword,
    )), array(
        'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0',
        'Accept' => 'text/html',
        'Accept-Language' => 'zh-cn,zh;q=0.8,ja;q=0.6,en-us;q=0.4,en;q=0.2',
        'Accept-Encoding' => 'gzip, deflate',
    ), array(
    ));

    $links = array();
    if($res->status_code == '200') {
        $dom = HtmlDomParser::str_get_html( $res->body );
        foreach($dom->find('.content li') as $li) {
            $titleLink = $li->find('.title', 0);
            $metaLink = $li->find('.meta a', 0);
            if(!$titleLink || !$metaLink) {
                continue;
            }
            $hash = preg_match('/btih:(\w+)/', $metaLink->href, $match);
            $hash = strtoupper($match[1]);
            $redirect = 'http://vod.xunlei.com/share.html?url=magnet%3A%3Fxt%3Durn%3Abtih%3A' . $hash;
            $links[] = array(
                'title' => strip_tags($titleLink->innertext),
                'hash' => $hash,
                'magnet' => html_entity_decode($metaLink->href),
                'redirect' => 'http://allovince.xunlei.com/redirect.html?' . http_build_query(array(
                    'url' => $redirect
                )),
            );
        }
    }
    $results = array(
        'count' => count($links),
        'results' => $links,
    );

    return $results;
}
*/

function getResultsFromBtdigg($keyword)
{
    $res = \Requests::get('http://btdigg.org/search?' . http_build_query(array(
        'q' => $keyword,
    )), array(
        'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0',
        'Accept' => 'text/html',
        'Accept-Language' => 'zh-cn,zh;q=0.8,ja;q=0.6,en-us;q=0.4,en;q=0.2',
        'Accept-Encoding' => 'gzip, deflate',
    ), array(
        'timeout' => 10
    ));

    $links = array();
    if($res->status_code == '200') {
        $dom = HtmlDomParser::str_get_html( $res->body );
        foreach($dom->find('#search_res tr') as $li) {
            $titleLink = $li->find('.torrent_name a', 0);
            $metaLink = $li->find('.ttth a', 0);
            if(!$titleLink || !$metaLink) {
                continue;
            }
            $hash = preg_match('/btih:(\w+)/', $metaLink->href, $match);
            $hash = strtoupper($match[1]);
            $redirect = 'http://vod.xunlei.com/share.html?url=magnet%3A%3Fxt%3Durn%3Abtih%3A' . $hash;
            $links[] = array(
                'title' => strip_tags($titleLink->innertext),
                'hash' => $hash,
                'magnet' => html_entity_decode($metaLink->href),
                'redirect' => 'http://allovince.xunlei.com/redirect.html?' . http_build_query(array(
                    'url' => $redirect
                )),
            );
        }
    }
    $results = array(
        'count' => count($links),
        'results' => $links,
    );

    return $results;
}

function getResultsFromShousibaocai($keyword)
{
    $res = \Requests::get('http://bt.shousibaocai.com/?' . http_build_query(array(
        's' => $keyword,
    )), array(
        'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0',
        'Accept' => 'text/html',
        'Accept-Language' => 'zh-cn,zh;q=0.8,ja;q=0.6,en-us;q=0.4,en;q=0.2',
        'Accept-Encoding' => 'gzip, deflate',
    ), array(
        'timeout' => 10
    ));

    $links = array();
    if($res->status_code == '200') {
        $dom = HtmlDomParser::str_get_html( $res->body );
        foreach($dom->find('.content li') as $li) {
            $titleLink = $li->find('.m-title a', 0);
            $metaLink = $li->find('.m-meta a', 0);
            if(!$titleLink || !$metaLink) {
                continue;
            }
            $hash = preg_match('/btih:(\w+)/', $metaLink->href, $match);
            $hash = strtoupper($match[1]);
            $redirect = 'http://vod.xunlei.com/share.html?url=magnet%3A%3Fxt%3Durn%3Abtih%3A' . $hash;
            $links[] = array(
                'title' => strip_tags($titleLink->innertext),
                'hash' => $hash,
                'magnet' => html_entity_decode($metaLink->href),
                'redirect' => 'http://allovince.xunlei.com/redirect.html?' . http_build_query(array(
                    'url' => $redirect
                )),
            );
        }
    }
    $results = array(
        'count' => count($links),
        'results' => $links,
    );

    return $results;
}

function getResultsFromTorrentkitty($keyword)
{
    $res = \Requests::get('http://www.xunl.us/search/' . urlencode($keyword), array(
        'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0',
        'Accept' => 'text/html',
        'Accept-Language' => 'zh-cn,zh;q=0.8,ja;q=0.6,en-us;q=0.4,en;q=0.2',
        'Accept-Encoding' => 'gzip, deflate',
    ), array(
        'timeout' => 100000
    ));

    $links = array();
    if($res->status_code == '200') {
        $dom = HtmlDomParser::str_get_html( $res->body );
        foreach($dom->find('.content li') as $li) {
            $titleLink = $li->find('.m-title a', 0);
            $metaLink = $li->find('.m-meta a', 0);
            if(!$titleLink || !$metaLink) {
                continue;
            }
            $hash = preg_match('/btih:(\w+)/', $metaLink->href, $match);
            $hash = strtoupper($match[1]);
            $redirect = 'http://vod.xunlei.com/share.html?url=magnet%3A%3Fxt%3Durn%3Abtih%3A' . $hash;
            $links[] = array(
                'title' => strip_tags($titleLink->innertext),
                'hash' => $hash,
                'magnet' => html_entity_decode($metaLink->href),
                'redirect' => 'http://allovince.xunlei.com/redirect.html?' . http_build_query(array(
                    'url' => $redirect
                )),
            );
        }
    }
    $results = array(
        'count' => count($links),
        'results' => $links,
    );

    return $results;
}

$keyword = isset($_GET['q']) ? $_GET['q'] : '';
$response = '';
if(!$keyword) {
    header('Location:http://avnpc.com/', false, 301);
} else {
    $cache = StorageFactory::factory(array(
        'adapter' => array(
            'name' => 'filesystem',
            'options' => array(
                'ttl' => 60,
                'dirLevel' => 2,
                'cacheDir' => __DIR__ . '/cache',
                'dirPermission' => 0755,
                'filePermission' => 0666,
                'namespaceSeparator' => 'evaxunlei_'
            ),
        ),
        'plugins' => array(
            'exception_handler' => array(
                'throw_exceptions' => true
            ),
            'serializer'
        )
    ));
    $cacheKey = md5($keyword);
    if (!$results = $cache->getItem($cacheKey)) {
        $results = getResultsFromBtdigg($keyword);
        $results += getResultsFromShousibaocai($keyword);
        $cache->setItem($cacheKey, $results);
    }
    toJSON($results);
}
