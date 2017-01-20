var indexcot=0;

function addFiles(table, ddl,item){
    var tbl= document.getElementById(table);
    var size=tbl.rows.length;
    var row=tbl.insertRow(size); 
    var links=row.insertCell(0);
    var a=document.createElement('div');
    var link = document.createTextNode((item));
    a.href = "http://example.com";
    a.id='link'+size;
    a.appendChild(link);
    links.appendChild(a);
    
    var cellbtndlt=row.insertCell(1);
    var btndlt=document.createElement('img');
    btndlt.id='btndlt'+size;
    btndlt.value='Eliminar Archivo';
    btndlt.src='../../themes/default/img/closeIcon.png';
    btndlt.className='boxclose';
    
    //elmininar elemento
    btndlt.addEventListener('click',function(){
    var td = this.parentNode;
    var tr = td.parentNode;
    var table = tr.parentNode;
    table.removeChild(tr);
    var x = document.getElementById(ddl);
    $("#"+ddl+" option").each(function(){         
    var oid=$(this).attr("value");
    if(oid===link.data)
         x.remove($(this).index());
    });
    var id=parseInt(btndlt.id.substring(6,100));
    var size=tbl.rows.length;
    while (id<size){
        var nid=id+1;
        document.getElementById('link'+(nid)).setAttribute('id','link'+id);     
        document.getElementById('btndlt'+(nid)).setAttribute('id','btndlt'+id);
        id=id+1;
       }
     indexcot=indexcot-1;
    
    });
    cellbtndlt.appendChild(btndlt);
 
}
