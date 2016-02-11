var http = require('http');
var https = require('https');
var fs = require('fs');
var request = require("request");
var cheerio = require("cheerio");
var BASE_URL="https://bulkdata.uspto.gov/data2/patent/grant/redbook/2015/";

request({
  uri: "https://bulkdata.uspto.gov/data2/patent/grant/redbook/2015/",
}, function(error, response, body) {
  var $ = cheerio.load(body);
  var linkList=[];
  $('td > a').each(function(){
    var link = $(this);
    linkList.push({
      url : link.attr('href'),
      name : link.text()
    });
    // console.log(link.text());
  });
  downloadFiles(linkList);
});
function downloadFiles(list){
  if(list && list instanceof Array){
    list.forEach(function(item,index){
      if(item && item.name && item.url){
        var file = fs.createWriteStream(item.name);
        //console.log(item);
        var request = https.get(BASE_URL+item.url, function(response) {
          //console.log(response);
          response.pipe(file);
        });

      }
    });
  }
}
// console.log(file);
