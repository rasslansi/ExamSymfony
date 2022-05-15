tds=document.getElementsByTagName('tr')

for(let i=0;i<tds.length;i++){
    tds[i].addEventListener('click',function(){
        this.classList.toggle('highlight')
    })
}

