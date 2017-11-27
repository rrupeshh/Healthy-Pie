function load(item_val) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            console.log('Response : ' + this.responseText);
            
            var obj = JSON.parse(this.responseText);
            
            itemAmount = document.getElementById("item_amt")
            
            if(obj.amount_value == 'true') {
                itemAmount.disabled = false;
                itemAmount.placeholder = obj.amount_unit;
            } else {
                itemAmount.disabled = true;
                itemAmount.placeholder = obj.amount_unit;
            }
        }
    }
    xhttp.open('GET','post_server.php?item_name='+item_val,true);
    xhttp.send(null);
}