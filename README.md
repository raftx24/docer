# docer
easily convert any url to pdf 
just add package to your project with running command below

`composer require raftx24/docer`

then you can use it like below

```
include 'docer_package/src/Docer/Pdf.php';
use Docer\Pdf;
$p = new Pdf();
$url = $p->linkToDownloadablePdf("https://api.blitbin.com//book/9f3ef68b398647769d30fdb4eb7b1a39/show");
$p->linkToPdfFile("https://api.blitbin.com//book/9f3ef68b398647769d30fdb4eb7b1a39/show",time().".pdf");
echo $url.PHP_EOL;
```