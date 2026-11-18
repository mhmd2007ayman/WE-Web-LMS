let content = document.getElementById('content')
let content2 = document.getElementById('content2')
let content3 = document.getElementById('content3')
let textEdit = document.getElementById('textEdit')
let italic = document.getElementById('italic').addEventListener('click',italicEdit)
let valueItalic= false
function italicEdit(){
    let italic = document.getElementById('italic')
    if(valueItalic == false){
        textEdit.style.fontStyle = 'italic'
        content.value = 'italic'
        italic.style.backgroundColor = 'gray'
        valueItalic =true

    }
    else{
        textEdit.style.fontStyle = 'normal'
        content.value = 'normal'
        italic.style.backgroundColor = 'transparent'
        valueItalic =false

    }
}
let bold = document.getElementById('bold').addEventListener('click',boldEdit)
let valuebold= false
function boldEdit(){
    let bold = document.getElementById('bold')
    if(valuebold == false){
        textEdit.style.fontWeight = 'bold'
        content2.value = 'bold'
        bold.style.backgroundColor = 'gray'
        valuebold =true

    }
    else{
        textEdit.style.fontWeight = 'normal'
        content2.value = 'normal'
        bold.style.backgroundColor = 'transparent'
        valuebold =false

    }
}

let under = document.getElementById('under').addEventListener('click',underEdit)
let valueunder= false
function underEdit(){
    let under = document.getElementById('under')
    if(valuebold == false){
        textEdit.style.textDecoration = 'underline'
        content3.value = 'underline'
        under.style.backgroundColor = 'gray'
        valueunder =true

    }
    else{
        textEdit.style.textDecoration = 'none'
        content3.value = 'none'
        under.style.backgroundColor = 'transparent'
        valueunder =false
    }
}
let uplod = document.getElementById('uplod').addEventListener('click',change)
function change(){
let up = document.getElementById('up')
up.click()
}
let up = document.getElementById('up').addEventListener('change',add)
function add(){
const image = this.files[0]
const reader = new FileReader()
reader.onload = ()=>{
let files = document.getElementById('files')
const read = reader.result
if(image.type=='application/pdf'){

}
let file = `<div class="d-flex flex-row justify-content-between mord" id='mord'>
    <p class="close" id='close' >X</p>
<div class="d-flex flex-row gap-2 ">
<a class="nameAndType"href='fileview.html' id='${read}'>${image.name}</a>
<div  class="img" ><img src='' class='img2' id='img2'></div>
</div>
</div>`

files.innerHTML += file
if(image.type==='application/pdf'){
let img =document.getElementById('img2')
img.src= `logo/Adobe\ PDF.png`
img.id = Date()    
}
else if(image.type==='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
let img =document.getElementById('img2')
img.src= `logo/powerpoint-6867647_1280.png`
img.id = Date() 


}
else if(image.type==='application/msword' ||image.type==='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
let img =document.getElementById('img2')
img.src= `logo/Microsoft_Word-Logo.wine.png`
img.id = Date() 


}
}

reader.readAsDataURL(image) 
}



let par = document.getElementById('modalPoster')
par.addEventListener('click',(e)=>{
if(e.target.classList.contains('close')){
e.target.parentElement.remove()
}
}) 
// let post = document.getElementById('doneAdd').addEventListener('click',(e)=>{
// if(textEdit.value == ''){
// let errorSend = `<div class="alert alert-danger" id='alert' role="alert">
// لا تتركها فارغه
// </div>`
// let modal= document.getElementById('modal')
// modal.innerHTML= errorSend 

// }
// else{
// let files = document.getElementById('files')
// let mmv = document.getElementsByClassName('close')
// let msge = `<div class="card" id='cardpro'>
// <div class="card-header h">
//     <div class="d-flex">
//         <div class="column ">
//             <span class="nameAcount">محمد</span>
//             <span class="time"></span>
//         </div>
//         <img src="img_breakfast_thumb.jpg" alt="" class="imgAcount">

//     </div>

//     <div class="s " id='first' >
//         <p class='delEdd show'>:</p>    
//     </div>

// </div>
// <div class="card-body b" id='carddff'>
//     <div class="card-dailog d">
//         <!-- <p id='prog'>${content.innerHTML=textEdit.value}</p> -->
//         <textarea  name="" id='prog' style="border: none;width: 100%; height:100%; resize: none; background-color:transparent" disabled>${content.innerHTML=textEdit.value}</textarea>
//         <div style='width: 100%;' id='parent'>${files.innerHTML}</div>
//     </div>
// </div>
// <div class="card-footer  fd" id='gg'>
//     <p class="text-dark nnv " id='nnf'>إضافة تعليق</p>

//     <div class="comments card" id='comments'>
// <div class="card-header d-flex flex-row justify-content-between head">
//     <button type="button" class="btn-close" aria-label="Close"></button>
//     <p>التعليقات</p>
// </div>
// <div class="card-body body2 d-flex flex-column gap-2 overflow-auto" ></div>
// <div class="card-footer d-flex flex-row justify-content-between foo">
//     <div id='se'><img src="blue send.png" class='clic sendd'></div>
//     <input type="text" class="text" id='text'>
// </div>
// </div>
// </div>
// </div>`
// let msg = document.getElementById('chat')
// msg.innerHTML += msge
// let prog = document.getElementById('prog')
// prog.style.fontStyle  =  textEdit.style.fontStyle 
// prog.style.fontWeight  =  textEdit.style.fontWeight
// prog.id = Date()

// let parent = document.getElementById('parent')
// let close= document.querySelectorAll(".close")
// close.disply='none' 
// // msg 
// // fetch('',{
// //     method:'POST',
// //     headers:{
// //         'Accept':'application/json',
// //         'Content-Type':'application/json'
// //     },
// //     body: JSON.stringify(msg)
// // })
// let mord =parent.getElementsByClassName('mord')
// mord.classList =`d-flex flex-row justify-content-end mord`
// }})







let first = document.getElementById('chat'). addEventListener('click',(e)=>{
    if(e.target.classList.contains('show')){
    // e.target.innerHTML = `<div class="lis w-xs-50" id='listA'>
    //     <!--<button class="btn btn-light text-dark a">تعديل</button>--!>
    //     <form method='POST'>
    // <button class="btn btn-danger text-light" data-value="<?php echo $id; ?>">حذف</button>
    // </form>
    // <button class="btn btn-primary z">الغاء</button>
    // </div>`
    e.target.style.display = 'none'
    let sibling = e.target.nextElementSibling
    sibling.style.display = 'flex'
    }
    else if(e.target.classList.contains('e')){
    e.target.parentElement.parentElement.parentElement.parentElement.parentElement.remove()
    }
    else if(e.target.classList.contains('z')){
    let element = e.target.parentElement
    element.style.display = 'none'
    let sibling = e.target.parentElement.previousElementSibling
    sibling.style.display = 'block'

    }
    else if (e.target.classList.contains('nnv')){
    let click = e.target.parentElement.click()
    }
    else if(e.target.classList.contains('fd')){
    let com = e.target
    let vv = com.getElementsByClassName('comments')
    vv[0].classList= `comments2 card`
    
    }
    else if(e.target.classList.contains('btn-close')){
    let close = e.target.parentElement.parentElement.classList =`comments card`
    }
    else if(e.target.classList.contains('nameAndType')){
    let read = e.target.id
    let local = localStorage.setItem('file',read)
    }
    
    else if (e.target.classList.contains('sendd')){
    let c = e.target.parentElement.parentElement
    let body2 = e.target.parentElement.parentElement.parentElement
    let chatCommennt2 = body2.getElementsByClassName('text')[0].value 
    }})
    let textEdit2 = document.getElementById('textEdit').addEventListener('focus',(e)=>{
    let alert = document.getElementById('alert')
    if(alert !== null){
    alert.remove()
    }
    
    
    
    })
    let photo = document.getElementById('modal2').addEventListener('click',(e)=>{
    if (e.target.classList.contains('im')){
    let src = e.target.src
    let back = document.getElementById('background')
    back.style.backgroundImage = `url(${src})`
    
    }
    })

let first2 = document.getElementById('chat'). addEventListener('click',(e)=>{
if(e.target.classList.contains('fd')){
    let com = e.target
    let vv = com.getElementsByClassName('comments')
    vv[0].classList= `comments2 card`
    
    }
})