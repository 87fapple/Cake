// var eatList = [
//     {id:'1', name: '鮮魚湯', source:'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3640.480693796195!2d120.6326197149891!3d24.1548689843916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3469177cf17e9a9b%3A0xd6a9294e3e2599a8!2z6a6u6a2a5rmv77yI6bG755qE6a2a6aOf5aCC77yJ!5e0!3m2!1szh-TW!2stw!4v1684734515276!5m2!1szh-TW!2stw'},

//     {id:'2', name: '八方雲集', source:'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d270.58147878254385!2d120.63462609786163!3d24.154334330490254!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34693de9af200497%3A0x4d7f835c03cf2188!2z5YWr5pa56Zuy6ZuGIOWPsOS4rem7juaYjuW6lw!5e0!3m2!1szh-TW!2stw!4v1684825971258!5m2!1szh-TW!2stw'},

//     {id:'3', name: '力饗站', source:'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d227.5292082061733!2d120.63445764230892!3d24.15533791960133!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34693d174b6a5a55%3A0xadec8659c0ba39ac!2z5Yqb6aWX56uZIOm7juaYjuWci-Wwj-W6lw!5e0!3m2!1szh-TW!2stw!4v1684826055775!5m2!1szh-TW!2stw'},

//     {id:'4', name: '香港燒臘', source:'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d227.5293341375712!2d120.63457340143624!3d24.15526721041333!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34693d2020a7e1b9%3A0xfebc18997948a4af!2z6aaZ5riv5qW15ZOB54eS6IeY5b-r6aSQ!5e0!3m2!1szh-TW!2stw!4v1684826086886!5m2!1szh-TW!2stw'},

//     {id:'5', name: 'aki 咖哩', source:'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d227.52983606116368!2d120.63461332787499!3d24.15498538353213!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34693d55f4295ff3%3A0xa7f08d93143a5f0d!2zYWtpIOWSluWTqQ!5e0!3m2!1szh-TW!2stw!4v1684826112288!5m2!1szh-TW!2stw'},
// ]

// 讀取本地端eatList.json檔案的程式碼
var eatList;
async function fetchEatList() {
    const response = await fetch('eatList.json');
    const data = await response.json();
    eatList = data;
}
fetchEatList();

$(document).ready(function() {
    $('#act').click(function(){
        var randomEat = eatList[Math.floor(Math.random() * eatList.length)]
        $('#result').attr('src', randomEat.source);
        $('#act').html(`
            <div class = 'h-100 w-100 d-flex justify-content-center 
            align-items-center' style="height:500px;">

                <div style="positioin:absolute; ; height:500px; width: 100%">
                    
                    <div style="positioin:absolute; top:10vh; height:100%; width: 100%; ">
                        <h1 class='d-flex justify-content-center'>${randomEat.name}</h1>
                        <img src="${randomEat.imgSrc}" style="height:500px; width: 100%; opacity: 0.4; margin-top:-5.3vh" class="img-fluid" alt="請輸入圖片連結!!!">
                    </div>
                    
                </div>

                

            </div>
        `);

        // $('#packList').html(`
        //     <div class="mapTitle bg-warning d-flex justify-content-center 
        //     align-items-center">
        //         <h1>增加口袋午餐</h1>
        //     </div>
        //     <div class="inputText mt-1 mb-1 h-100" style="border: 2px solid gray; border-radius: 10px;">
        //         <label for="inputName">請輸入店名</label>
        //         <input class="mt-1 mb-2" type="text" name="inputName" id="inputName"><br>
        //         <label for="iframeSrc">請輸入Google map Source</label>
        //         <input class="mt-1 mb-2" type="text" name="iframeSrc" id="iframeSrc">
        //         <label for="imgSrc">請輸入img Source</label>
        //         <input class="mt-1 mb-0" type="text" name="imgSrc" id="imgSrc">
        //         <button id="saveBtn" class="btn bg-secondary m-3">存入</button>
        //     </div>
        // `)

        showToast("今天吃", randomEat.name, 'warning');
    });

    $('#saveBtn').click(function(){
        checkNamePush();
    });

});

async function checkNamePush(){
    var nameToCheck = $('#inputName').val();
    var isNameInArray = false;

    for (var i = 0; i < eatList.length; i++) {
        if (eatList[i].name === nameToCheck) {
            isNameInArray = true;
            break;
        }
    }
    
    if (isNameInArray) {
        alert('已存在該筆資料');
    } else {
        eatList.push({id: eatList.length +1, name: $('#inputName').val(), 
        source:$('#iframeSrc').val(), imgSrc:$('#imgSrc').val()});
        showToast('存入囉');
    }
}

async function showToast(heading, message, icon) {
    $.toast({
        text: message, // Text that is to be shown in the toast
        heading: heading, // Optional heading to be shown on the toast
        icon: icon, // Type of toast icon
        showHideTransition: 'fade', // fade, slide or plain
        allowToastClose: true, // Boolean value true or false
        hideAfter: 2000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
        stack: 3, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
        position: 'bottom-right', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
        textAlign: 'center',  // Text alignment i.e. left, right or center
        loader: true,  // Whether to show loader or not. True by default
        loaderBg: '#9ec600',  // Background color of the toast loader
        beforeShow: function () { }, // will be triggered before the toast is shown
        afterShown: function () { }, // will be triggered after the toat has been shown
        beforeHide: function () { }, // will be triggered before the toast gets hidden
        afterHidden: function () { }  // will be triggered after the toast has been hidden
    });
}


