<?php

namespace Docer;
class Pdf
{
    private $baseUrl = "http://docer.webtab.ir/makePdf";

    private function toPdfLink($link, $options = [])
    {
        $options["link"] = $link;
        $output = file_get_contents($this->baseUrl . "?" . http_build_query($options));
        return json_decode($output, true);
    }

    private function toPdfHtml($html, $options = [])
    {
        $options["html"] = $html;
        return $this->sendPostRequest(http_build_query($options));
    }

    public function linkToDownloadablePdf($link, $options = [])
    {
        $result = $this->toPdfLink($link,$options);
        return isset($result["download_url"]) ? $result["download_url"] : null;
    }

    public function linkToBase64Pdf($link, $options = [])
    {
        $result = $this->toPdfLink($link,$options);
        return isset($result["content"]) ? $result["content"] : null;
    }

    public function linkToPdfFile($link, $filePath, $options = [])
    {
        $content = $this->linkToBase64Pdf($link,$options);
        return file_put_contents($filePath, base64_decode($content));
    }

    public function htmlToDownloadablePdf($html, $options = [])
    {
        $result = $this->toPdfHtml($html,$options);
        return isset($result["download_url"]) ? $result["download_url"] : null;
    }

    public function htmlToBase64Pdf($html, $options = [])
    {
        $result = $this->toPdfHtml($html,$options);
        return isset($result["content"]) ? $result["content"] : null;
    }

    public function htmlToPdfFile($html, $filePath, $options = [])
    {
        $content = $this->htmlToBase64Pdf($html,$options);
        return file_put_contents($filePath, base64_decode($content));
    }

    /**
     * @param string $param
     * @return bool|mixed|string
     */
    private function sendPostRequest($param)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            $param);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        $server_output = json_decode($server_output, true);
        return $server_output;
    }
}
