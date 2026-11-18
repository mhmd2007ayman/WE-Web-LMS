let valueInput= document.getElementById('inp');
let valueInputt= document.getElementById('inp');
let valueInput2= document.getElementById('inp2');
let valueInput3= document.getElementById('inp3');
let btnValue= document.getElementById('doneAdd').addEventListener('click',addCard);
let btnValue2= document.getElementById('doneAdd2').addEventListener('click',addCard2);
let del =document.getElementById('zz')
let divQ = document.getElementById('divQ')
let divQQ = document.getElementById('divQQ')
let cardA = document.getElementById('cardA')
let cardList=[]
let cardstudy=[]
var xx=0
var zz=0
function again(){
    let NN=document.getElementById('NN')
    if(NN!==null){

        NN.remove()
        return addCard2
    }
        
}

if(window.localStorage.getItem('cardList')){
    cardList = JSON.parse(localStorage.getItem("cardList"));
    setToPage(cardList)
};
function addCard(){
        if(valueInput.value==''){
            let moro = document.getElementById('moro')
           err = `<div class="bg-danger text-light" id="NN">لا تتركها فارغه</div>`
           moro.innerHTML=err 
        }
        else if(cardList.includes(valueInput.value)){
            let moro = document.getElementById('moro')
            err = `<div class="bg-danger text-light" id="NN">إنها موجوده</div>`
            moro.innerHTML=err
    
    
        }
        else{
            let moro = document.getElementById('moro')
            err = `<div class="bg-success text-light" id="NN">تم</div>`
            moro.innerHTML=err 

            let cardBody=` 
            <div class="card bg-dark cardBody cardd mt-3" id='cardd'>          
             <h2 class="car-header text-light " id='${xx+=1}'>
            ${xx}بطاقة 
            </h2>
            <div class="card-body  ">
             <h3 class="card-title text-warning">${valueInput.value}</h3>
            </div>
            <div class="card-footerr bg-dark  gap-1" id='carddd'>
             <a class="btn btn-danger"   href="showQuestions.php" date-id='${valueInput.value}'>رؤية السؤال</a>
             <button class="btn btn-danger AddQuestion " id='add' date-id='${valueInput.value}' data-bs-toggle="modal" data-bs-target="#modalQ">اضافة السؤال</button>
             <button class="btn btn-danger del" id='zz'  date-id='${valueInput.value}'>حذف</button>
            </div>
            </div>`
            cardList.push(valueInput.value)
            
                divQQ.innerHTML+=cardBody
                saveToLocal(cardList)
        }

    }



function saveToLocal(cardList){
    localStorage.setItem('cardList',JSON.stringify(cardList))

}
function setToPage(){
    for(let m =0 ;m<cardList.length;m++){
        let cardBody=` 
<div class="card bg-dark cardBody cardd mt-3" id='cardd'>          
 <h2 class="car-header text-light " id='${xx+=1}'>
${xx}بطاقة 
</h2>
<div class="card-body  ">
 <h3 class="card-title text-warning">${cardList[m]}</h3>
</div>
<div class="card-footerr bg-dark  gap-1" id='carddd'>
 <a class="btn btn-danger"   href="questions.html" date-id='${cardList[m]}'>رؤية السؤال</a>
 <button class="btn btn-danger AddQuestion " id='add' date-id='${cardList[m]}' data-bs-toggle="modal" data-bs-target="#modalQ">اضافة السؤال</button>
 <button class="btn btn-danger del" id='zz'  date-id='${cardList[m]}'>حذف</button>
</div>
</div>`
divQQ.innerHTML+=cardBody
    }

}

// let xv=[] 
let zz0=''
divQQ.addEventListener('click',(e)=>{
    if(e.target.classList.contains('AddQuestion')){
     zz0 =e.target.getAttribute('date-id') 

    }
})

let hh = document.getElementById('carddd')
divQQ.addEventListener('click',(e)=>{
    if(e.target.classList.contains('del')){
        e.target.parentElement.parentElement.remove()
        localStorage.removeItem(e.target.getAttribute('date-id'))
         deleteFromLocal(e.target.getAttribute('date-id'))
         xx-=1

    }

    

})
divQQ.addEventListener('click',(e)=>{
    let item=e.target.getAttribute('date-id')
    window.localStorage.setItem('item',item)
    
})





function addCard2(){
    if(window.localStorage.getItem(zz0)){
        cardstudy=[]
    let xx = JSON.parse(localStorage.getItem(zz0)) ;
     cardstudy.push(xx)
    }
    


    
    qs=`

<div class='row d-flex fd col-md-3 col-sm-12 col-xs-12' id='card' date-id='${valueInput2.value}'>
    <div class="Questions row d-flex justify-content-center col-12">
    <p class="Q col-12 m-auto">${valueInput2.value}</p>
    <div class="A row d-flex justify-content-center">
        <p class='col-12 m-auto'>${valueInput3.value}</p>
    </div>
    </div>
    <button class="btn btn-danger del d-block col-3" type='button' id='del'>حذف</button>
    </div>


`
    cardstudy.push(qs)
    setToPageAnother(cardstudy)

}




function deleteFromLocal(del){
   let doneDel = cardList.filter(ele=>ele!=del)
   cardList=doneDel
    saveToLocal(cardList)

}

function setToPageAnother(cardstudy){
    window.localStorage.setItem(zz0,JSON.stringify(cardstudy))
}
function dd(cc){
    let doneDel = xv.filter(ele=>ele!=cc)
    xv=doneDel
    console.log(xv)

}