<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>电影选票</title>
    <link href="stylesheets/style.css" rel="stylesheet"/>
    <script src="javascripts/jquery/3.1.1/jquery.js" type="text/javascript"></script>
    <script src="javascripts/layer/layer.js" type="text/javascript"></script>
    <style>
        .mask {
            position: absolute;
            top: 0px;
            filter: alpha(opacity=60);
            background-color: #777;
            z-index: 1002;
            left: 0px;
            opacity: 0.5;
            -moz-opacity: 0.5;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="mask">

    </div>
    <div class="main_wrapper">
        <div class="seat_tip">

        </div>
        <h2><span>银幕</span></h2>
        <div class="seat_content">


        </div>
    </div>

    <div id="selectedList">

    </div>

    <div class="choose_seat">
        <form>
            <label>输入手机号</label><input type="text" value="13617191021" class="phone"/>
            <p class="center">
                <a href="javascript:;" id="submitOrder">提交订单</a>
            </p>


        </form>
    </div>


</div>

<script>
    var selectedList = [];
    $(document).ready(function () {
        initSeat();
    });

    $(document).on('click', '#submitOrder', function () {
        var phone = $('.choose_seat form .phone').val();
        var filmId = '11122';
        var cinemaId = '236523';
        var layerIndex = showLoader();

        $.ajax({
            url: 'http://fangmaoyan/xuanzuo/order/create',
            type: 'post',
            dataType: 'json',
            data: {'phone': phone,cinemaId:cinemaId,filmId:filmId},
            success: function (data) {
                console.log(data);

                if (data.status == 200) {

                } else {

                }
                hideLoader(layerIndex);

            },
            error: function (data) {
                console.log(data);
                hideLoader(layerIndex);
                alert('获取数据失败,请稍后重试');
            }
        });
        return false;

    });

    function refreshList() {
        console.log(selectedList);
        $('#selectedList').empty();
        var result = '';
        for (var index in selectedList) {
            result += '<p>' + selectedList[index] + '</p>';
        }
        $('#selectedList').append(result);
    }


    $(document).on('click', '.seat_content a.seat', function () {
        if ($(this).hasClass('disabled')) {
            alert('disabled');
        } else if ($(this).hasClass('selected')) {
            $(this).removeClass('selected');

            selectedList.splice(selectedList.indexOf($(this).attr('data-no')), 1);
            refreshList();
        }
        else if ($(this).hasClass('active')) {
            if (selectedList.length < 4) {
                $(this).addClass('selected');
                selectedList.push($(this).attr('data-no'));

                refreshList();
            } else {
                alert('最多只能选4个');
            }
        }
    });

    function initSeat() {
        var seats = [
            [null, null, null, null, null, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, null, null, null, null, null],
            [null, null, null, null, null, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, null, null, null, null, null],
            [null, null, null, null, null, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
            [null, null, null, null, null, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
            [null, null, null, null, null, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, null, null, 1, 1, 1],
            [null, null, null, null, null, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, null, null, 1, 1, 1],
            [null, null, null, null, null, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, null, null, 1, 1, 1]
        ];
        var result = '';
        for (var x in seats) {
            result += '<p><span class="num">' + (parseInt(x) + 1) + '</span>';
            var row = seats[x];
            for (var y in row) {
                if (row[y] == null) {
                    result += '<span class="seat"></span>';
                } else if (row[y] == 1) {
//                    data-no 参数含义: 影院id-影片id-座位row-座位col

                    result += '<a href="javascript:;" hidefocus="true" class="seat active" data-no="0000000000000001-6-18" data-type="N" data-row="6" data-column="18" title="6排18座"></a>';
                } else if (row[y] == 0) {
                    result += '<a href="javascript:;" hidefocus="true" class="seat disabled" data-no="0000000000000001-7-07" data-type="LK" data-row="7" data-column="07" title="7排07座"></a>';
                } else {
                    alert('非法请求');
                }
            }
        }
        $('.seat_content').append(result);


    }

    //    var layerIndex;
    function showLoader(loadingText) {

        layerIndex = layer.load(1, {
            shade: [0.6, '#fff'] //0.1透明度的白色背景
        });
        return layerIndex;

    }


    function hideLoader(layerIndex) {
        layer.close(layerIndex);
    }


</script>


</body>
</html>