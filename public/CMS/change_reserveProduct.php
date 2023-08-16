<?php session_start(); ?>
<?php
require('../php/DB.php');

$cInfo = [];

$oToken = $_COOKIE["oToken"];
DB::select("select * from orders where oToken = ?", function ($rows) use (&$cInfo) {
    $cInfo[] = $rows[0];
}, [$oToken]);

$oInfo = [];
if (isset($_GET['checkedoToken'])) {
    DB::select("select * from orders where oToken = ?", function ($rows) {
        if (count($rows) === 0) {
            header('Location: /Cake/public/error.php?error_code=1');
            die();
        }
    }, [$_GET['checkedoToken']]);

    $checkoToken = $_GET['checkedoToken'];

    DB::select("select c.cid,c.cName,ol.num from orderlist ol INNER JOIN orders o on o.oid = ol.oid INNER JOIN cake c on c.cid = ol.cid where o.oToken = ?", function ($rows) use (&$oInfo) {
        if (count($rows) !== 0) {
            $oInfo = $rows;
        }
    }, [$checkoToken]);
}

var_dump($oInfo);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <!-- <link rel="stylesheet" href="jqueryui/style.css"> -->
    <link rel="stylesheet" href="../../resources/css/reserve1.css">

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <script>
        $(function () {
            const cInfoSid = <?= $cInfo[0]["sid"] ?>;
            $("#hidden").hide();
            let data;
            let nameFilled = false;
            let newNameFilled = false;
            let numFilled = false;
            let currentDivIndex = 0;

            var people = $("#people").val();
            <?php if (isset($oInfo) && !empty($oInfo)) { ?>
                const cInfoMNum = <?= $cInfo[0]["people"] - $cInfo[0]["companion"] ?>;
                var view1 = `<option value=${cInfoMNum} style="display: none;">${cInfoMNum}份</option>`;
                $("#hidden").show();
            <?php } else { ?>
                var view1 = '<option style="display: none;">請選擇製作份數</option>';
            <?php } ?>
            var numList = [];
        for (var i = Math.round(people / 2); i <= people; i++) {
            view1 += `
                            <option value=${i}>${i}份</option>
                        `;
        }
        document.getElementById("makeNum").innerHTML = view1;

        var mNum = $("#makeNum option:selected").val();
            <?php if (isset($oInfo) && !empty($oInfo)) { ?>
                var optionsCid = <?php echo json_encode(array_column($oInfo, 'cid')); ?>;
                var optionsName = <?php echo json_encode(array_column($oInfo, 'cName')); ?>;
                var optionsNum = <?php echo json_encode(array_column($oInfo, 'num')); ?>;

                let viewBaseC = `<option style="display: none;" value="${optionsCid[0]}">${optionsName[0]}</option>
                                    <optgroup label="蛋糕" id="cake">
                                    <optgroup label="點心" id="dessert">`;
                let viewBaseN = `<option style="display: none;" value="${optionsNum[0]}">${optionsNum[0]}份</option>`;
                let view4 = '';
                $("#addnewdiv").hide();

                for (let a = 1; a < mNum; a++) {
                    if (typeof (optionsName[a], optionsCid[a]) === 'undefined') {
                        optionsCid[a] = '';
                        optionsName[a] = '';
                    }
                    view4 += `
                            <div id="newbase">
                                <div id="newdiv${a}" class="newdivArea">
                                    <label for="newCakeName${a}">選擇產品</label>
                                        <select id="newCakeName${a}" name="newCakeName${a}" class="newSelect">
                                        <?php if (isset($oInfo) && !empty($oInfo)) { ?>
                                                <option style="display: none;" value="${optionsCid[a]}">${optionsName[a]}</option>
                                        <?php } else { ?>
                                                <option style="display: none;" value="">請選擇產品</option>
                                        <?php } ?>
                                            <optgroup label="蛋糕" id="newCake${a}">
                                            <optgroup label="點心" id="newDessert${a}">
                                        </select>
                                        <br>
                                    <label for="newNum${a}">選擇份數</label>
                                        <select id="newNum${a}" name="newNum${a}" class="newSelect"></select>
                                        <br>
                                        <input type="button" id="hideNewDiv${a}" value="移除" onClick="hideNewDivs(${a})" class="removeBtn"/>
                                </div>
                            </div>
                            `;
                }
                $("#newChoose").html(view4);
                $("#companion").val(people - mNum);
            <?php } else { ?>
                let viewBaseC = `<option style="display: none;" value="">請選擇產品</option>
                                    <optgroup label="蛋糕" id="cake">
                                    <optgroup label="點心" id="dessert">`;
                let viewBaseN = `<option style="display: none;" value="">請選擇數量</option>`;
            <?php } ?>
            // console.log(viewBaseC, viewBaseN);
            document.getElementById("cakeName").innerHTML = viewBaseC;
            document.getElementById("num").innerHTML = viewBaseN;

            <?php if (isset($oInfo) && !empty($oInfo)) { ?>
                for (let i = 1; i < mNum ; i++) {
                    universalNums(i);
                }
            <?php } ?>

            $("#makeNum").on('change', function (e) {
                let mNum = $("#makeNum option:selected").val();
                let people = $("#people").val();
                let view4 = '';
                numFilled = false;
                newNameFilled = false;
                currentDivIndex = 0;

                for (let a = 1; a < mNum; a++) {

                <?php if (isset($oInfo) && !empty($oInfo)) { ?>
                        if (typeof (optionsName[a], optionsCid[a]) === 'undefined') {
                                optionsCid[a] = '';
                                optionsName[a] = '';
                            }
                <?php } ?>

                    view4 += `
                    <div id="newbase">
                        <div id="newdiv${a}" style="display:none" class="newdivArea">
                            <label for="newCakeName${a}">選擇產品</label>
                                <select id="newCakeName${a}" name="newCakeName${a}" class="newSelect">
                                <?php if (isset($oInfo) && !empty($oInfo)) { ?>
                                        <option style="display: none;" value="${optionsCid[a]}">${optionsName[a]}</option>
                                <?php } else { ?>
                                        <option style="display: none;" value="">請選擇產品</option>
                                <?php } ?>
                                    <optgroup label="蛋糕" id="newCake${a}">
                                    <optgroup label="點心" id="newDessert${a}">
                                </select>
                                <br>
                            <label for="newNum${a}">選擇份數</label>
                                <select id="newNum${a}" name="newNum${a}" class="newSelect"></select>
                                <br>
                                <input type="button" id="hideNewDiv${a}" value="移除" onClick="hideNewDivs(${a})" class="removeBtn"/>
                        </div>
                    </div>
                    `;
                }
                $("#newChoose").html(view4);


                for (let i = 1; i < mNum; i++) {
                    universalNums(i);
                }

                if (mNum == 1) {
                    universalNums(0);
                    $("#addnewdiv").hide();
                } else {
                    $("#addnewdiv").show();
                }

                $("#companion").val(people - mNum);
                $("#hidden").show();
            })

        fetch(`storeToCake_sql.php?indexInfo=${cInfoSid}`)
            .then(function (response) {
                return response.json();
            })
            .then(function (responseData) {
                data = responseData;
                universalOptions();
            })

        document.getElementById("addnewdiv").onclick = function (e) {
            nextNewNumber();
        }

        function nextNewNumber() {
            var mNum = parseInt($("#makeNum option:selected").val(), 10);
            const newDivs = $("[id^='newdiv']");
            
            // console.log(currentDivIndex,mNum);
            if (currentDivIndex < mNum) {
                $(newDivs[currentDivIndex]).show();
                currentDivIndex += 1;
                universalOptions(currentDivIndex);
                universalNums(currentDivIndex);
            }
            if (currentDivIndex == mNum - 1) {
                $("#addnewdiv").hide();
                currentDivIndex += 2;
            } else if (currentDivIndex > mNum) {
                let hideNewDivIndex = [];
                for (let i = 0; i < mNum; i++) {
                    if ($(newDivs[i]).is(':hidden')) {
                        hideNewDivIndex.push(i);
                    }
                }
                $(newDivs[hideNewDivIndex.shift()]).show();

                if (hideNewDivIndex.length === 0) {
                    $("#addnewdiv").hide();
                }
            }
        }

        function universalOptions() {
            var mNum = $("#makeNum option:selected").val();

            let cakeView = '';
            let dessertView = '';

            data.forEach(function (e) {
                switch (e.kind) {
                    case '蛋糕':
                        cakeView += `
                                <option value="${e.cid}">${e.cName}</option>
                            `;
                        break;
                    case '點心':
                        dessertView += `
                                <option value="${e.cid}">${e.cName}</option>
                            `;
                        break;
                }
            });

            function fillOptions(eleId, options) {
                const element = document.getElementById(eleId);
                if (element) {
                    element.innerHTML = options;
                }
            }

            if (!nameFilled) {
                fillOptions("cake", cakeView);
                fillOptions("dessert", dessertView);
                nameFilled = true;
            }

            if (!newNameFilled) {
                for (let x = 0; x < mNum; x++) {
                    fillOptions("newCake" + x, cakeView);
                    fillOptions("newDessert" + x, dessertView);
                    newNameFilled = true;
                }
            }
        }

        function universalNums(e) {
            var mNum = $("#makeNum option:selected").val();

                <?php if (isset($oInfo) && !empty($oInfo)) { ?>
                    let viewB = `<option style="display: none;" value="${optionsNum[0]}">${optionsNum[0]}份</option>`;
                    if (typeof (optionsNum[e]) === 'undefined') {
                        optionsNum[e] = "";
                    }
                    let view2 = `<option style="display: none;" value="${optionsNum[e]}">${optionsNum[e]}份</option>`;
                <?php } else { ?>
                    let viewB = `<option style="display: none;" value="">品項數量</option>`;
                    let view2 = `<option style="display: none;" value="">品項數量</option>`;
                <?php } ?>

                for (let i = 1; i <= mNum; i++) {
                viewB += `
                        <option value=${i}>${i}份</option>
                    `;
                view2 += `
                        <option value=${i}>${i}份</option>
                    `;
                }

            const numElement = document.getElementById("num");
            if (numElement) {
                numElement.innerHTML = viewB;
            }

            if(e !== 0){
                const newNumElement = document.getElementById("newNum" + e);
                newNumElement.innerHTML = view2;
            }
        }
        });

        function hideNewDivs(num) {
            $("#newdiv" + num).hide();
            $("#addnewdiv").show();
        }

        window.onload = function (e) {
            let isSubmitting = false;
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.onclick = function (e) {
                e.preventDefault();

                if (isSubmitting) {
                    return;
                }

                const productForm = document.getElementById('productForm');
                const formData = new FormData(productForm);

                const newDivsForm = document.querySelectorAll('[id^="newdiv"]');
                newDivsForm.forEach(div => {
                    const isHidden = window.getComputedStyle(div).display === 'none';
                    if (isHidden) {
                        const newCakeName = div.querySelector('[id^="newCakeName"]').name;
                        const newNum = div.querySelector('[id^="newNum"]').name;
                        formData.delete(newCakeName);
                        formData.delete(newNum);
                    }
                });

                const ckCakeName = $("#cakeName option:selected").val();
                const mNum = $("#makeNum option:selected").val();
                const ckNum = $("#num option:selected").val();

                const newDivs = $("[id^='newdiv']");
                for (let i = 0; i < newDivs.length; i++) {
                    if (!$(newDivs[i]).is(':hidden')) {
                        const newCakeName = $(newDivs[i]).find("[id^='newCakeName']").val();
                        const newNum = $(newDivs[i]).find("[id^='newNum']").val();
                        // console.log(newCakeName);
                        // console.log(newNum);

                        if (!newCakeName || !newNum) {
                            alert("請選擇新建的產品和份數");
                            return;
                        }
                    }
                }

                if (!ckCakeName || !ckNum) {
                    alert("請選擇產品和份數");
                    return;
                } else {
                    fetch('insertOrdersCake.php', {
                        method: "POST",
                        body: formData
                    })
                        .then(function (response) {
                            return response.text();
                        })
                        .then(function (data) {
                            if (data == "change_reserveTotal.php") {
                                isSubmitting = true;
                                $("#submitButton").disabled = true;
                                location.href = data;
                            } else {
                                let view = '';
                                view += `
                                    <div>${data}</div>
                                `;
                                document.getElementById("test").innerHTML = view
                            }
                        })
                }
            }
        }
    </script>


</head>

<body>
    <h3>預約</h3>
    <div class="container">
        <?php if (isset($oInfo)) { ?>
            <h2>重新選擇品項</h2>
        <?php } else { ?>
            <h2>選擇品項</h2>
        <?php } ?>
        <div class="scd-container">
            <form id="productForm">
                <div>目前預定人數
                    <input type="hidden" id="oid" name="oid" value="<?= $cInfo[0]["oid"] ?>">
                    <input type="text" id="people" value="<?= $cInfo[0]["people"] ?>" disabled>
                    <br>
                    <label for="makeNum">製作份數</label>
                    <select id="makeNum" name="makeNum">
                    </select>
                    <span>陪同人數:</span><input type="text" id="companion" name="companion" value="0" readonly="readonly">
                </div>
                <div>注意：一份甜點最多一位陪同，將酌收陪同費120元/人。</div>

                <br><br>
                <div id="hidden">
                    <div id="baseChoose">
                        <label for="cakeName">選擇產品</label>
                        <br>
                        <select id="cakeName" name="cakeName">
                            <option style="display: none;" value="">請選擇產品</option>
                            <optgroup label="蛋糕" id="cake">
                            <optgroup label="點心" id="dessert">
                        </select>
                        <label for="num">份數</label>
                        <br>
                        <select id="num" name="num">
                        </select>
                    </div>
                    <div id="newChoose"></div>

                    <input type="button" id="addnewdiv" value="新增品項">
                    <div>注意：若選取的甜點份數未滿製作份數，剩餘份數系統會自動轉成現場挑選，可現場到實體店面再做確認製作項目</div>
                    <br>

                    <?php if (isset($checkoToken)) { ?>
                        <input type="hidden" name="checkedoToken" value="<?= $checkoToken; ?>">
                    <?php } ?>
                    <input type="button" value="確認產品" id="submitBtn" ;>
                    <div id="test"></div>
                </div>
            </form>
        </div>
    </div>



</body>
</html>