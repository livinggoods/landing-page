var xhr = new XMLHttpRequest();

var links ={'name':'About Us', 'URL':'www.google.com'};

var data = 'links=' + JSON.stringify(links);

console.log(data);

var url = '/admin/php/upload.php';

xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
        console.log(xhr.responseText);
    }

    if (xhr.readyState != 4) {
        console.log("state was not 4, it was " + xhr.readyState);
    }
}

xhr.open("POST", url, true);
xhr.setRequestHeader("content-type", "application/x-www-form-urlencoded");
xhr.send(data);