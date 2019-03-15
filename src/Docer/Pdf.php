<?php

namespace Docer;
class Pdf
{
    private $baseUrl = "http://localhost/Docer/public/makePdf";

//    private $baseUrl = "http://docer.webtab.ir/toPdf";

    private function toPdf($link)
    {
        $output = file_get_contents($this->baseUrl . "?link=" . $link);
        return json_decode($output, true);
    }

    public function linkToDownloadablePdf($link)
    {
        $result = $this->toPdf($link);
        return isset($result["download_url"]) ? $result["download_url"] : null;
    }

    public function linkToBase64Pdf($link)
    {
        $result = $this->toPdf($link);
        return isset($result["content"]) ? $result["content"] : null;
    }

    public function linkToPdfFile($link, $filePath)
    {
        $content = $this->linkToBase64Pdf($link);
        return file_put_contents($filePath, base64_decode($content));
    }
}