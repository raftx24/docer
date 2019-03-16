# docer
easily convert any url or html to pdf 
just add package to your project with running command below

`composer require raftx24/docer`

then you can use it like belowy

```
include "vendor/autoload.php";
use Docer\Pdf;
$p = new Pdf();
$url = $p->linkToDownloadablePdf("https://github.com");
$p->linkToPdfFile("https://github.com",time().".pdf");
echo $url.PHP_EOL;
$p->htmlToPdfFile("<h1>hello world!</h1>",time()."2.pdf");



```
