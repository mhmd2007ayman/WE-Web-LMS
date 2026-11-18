let list=[]
let x = window.localStorage.getItem('item');
let xx = JSON.parse(localStorage.getItem(x));
list.push(xx)
for(let m=0;m<list.length;m++){
    let ele = document.getElementById("Con").innerHTML += list[m];
}


let Con= document.getElementById('Con');
Con.addEventListener('click',(e)=>{
    if(e.target.classList.contains("del")){
         deletee(e.target.parentElement)
        e.target.parentElement.remove()
        deletee()
        
    }

})

function deletee(){
    let Con= document.getElementById('Con');
    let newList=[];
    newList.push(Con.innerHTML)
    edit2(newList)
}

function edit(){
    window.localStorage.setItem(x,JSON.stringify(list))
}
function edit2(newList){
let x = window.localStorage.getItem('item');
let nn = window.localStorage.setItem(x,JSON.stringify(newList))


}