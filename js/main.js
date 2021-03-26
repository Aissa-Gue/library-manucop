// add Descent
var a = 2;
$("#addDescent").click(function () {
    if (a <= 5) {
        var html = '';
        html += '<div class="form-group col-md-2">';
        html += '<label for="descent">&nbsp;</label>';
        html +=
            '<input type="text" class="form-control" name="descent' + a + '" id="descent" placeholder = "أدخل النسبة ' + a + '" >';
        html += '</div>';
        //$('#addDescent').append(html);
        $(html).insertBefore("#addDescent");
        if (a == 5) $("#addDescent").remove();
        a++;
    }
});

// add other cop name
var b = 2;
$("#addOther_name").click(function () {
    if (b <= 4) {
        var html = '';
        html += '<div class="form-group col-md-7">';
        html +=
            '<input type="text" class="form-control" name="other_name' + b + '" id="other_name" placeholder="أدخل الصيغة ' + b + '" >';
        html += '</div>';
        $(html).insertBefore("#addOther_name");
        $('#addOther_name').css('margin-top', '5px');
        if (b == 4) $("#addOther_name").remove();
        b++;
    }
});

// add subject
var c = 2;
$("#addSubject").click(function () {
    if (c <= 5) {
        var html = '';
        html += '<div class="form-group col-md-auto">';
        html += '<label for="subject">&nbsp;</label>';
        html +=
            '<input list="subjects" class="form-control" name="subj_name'+c+'" id="subject" placeholder="حدد الموضوع '+c+'">';
        html += '<datalist id="subjects">';
        html += '<?php for ($i = 0; $i <= $lastSubjKey; $i++) { ?>';
        html += '<option value="<?php print_r($rowsSubj[$i][subj_id]); ?> # <?php print_r($rowsSubj[$i][subj_name]); ?>">';
        html += '<?php  } ?>';
        html += '</datalist>';
        html += '</div>';
        $(html).insertBefore("#addSubject");
        if (c == 5) $("#addSubject").remove();
        c++;
    }
});

// Replace cop Date with range
$("#replaceCopDate").click(function () {
    var html = '';
    html += '<div class="form-row" id="cop_date"> <div class="form-group col-md-2"> <label for="cop_date">تاريخ النسخ [أدخل نطاق]</label> <input type="number" class="form-control" name="cop_syear" id="cop_date" placeholder="من السنة"></div>';
    html += '<div class="form-group col-md-2"> <label for="cop_date">&nbsp;</label> <input type="number" class="form-control" name="cop_eyear" id="cop_date" placeholder="إلى السنة"> </div>';
    
    html += '<div class="form-group col-md-2">';
    html += '<label for="date_type">نوع التقويم</label>';
    html += '<select name="date_type" id="date_type" class="custom-select">';
    html += '<option value="1">ميلادي</option>';
    html += '<option value="0" selected>هجري</option>';
    html += '</select>';
    html += '</div>';
    html += '</div>' //end form-row;

    $("#cop_date").replaceWith(html);
});

// add auther - insertForm.php
var d = 2;
$("#addAuthor").click(function () {
    if (d <= 3) {
        var html = '';
        html += '<div class="form-group col-md-7">';
        html +=
            '<input list="authors" class="form-control" name="auth_name'+d+'" id="author" placeholder="حدد المؤلف '+d+'">';
        html += '<datalist id="authors">';
        html += '<?php for ($i = 0; $i <= $lastAuthKey; $i++) { ?>';
        html += '<option value="<?php print_r($rowsAuth[$i][auth_name]); ?> # <?php print_r($rowsAuth[$i][auth_id]); ?>">';
        html += '<?php  } ?>'
        html += '</datalist>';
        html += '</div>';
        $(html).insertBefore("#addAuthor");
        $('#addAuthor').css('margin-top', '5px');
        if (d == 3) $("#addAuthor").remove();
        d++;
    }
});

// add cop font match
var e = 2;
$("#addFontMatch").click(function () {
    if (e <= 5) {
        var html = '';
        html += '<div class="form-group col-md-2">';
        html += '<input type="number" class="form-control" name="cop_match'+e+'" id="cop_match" placeholder="أدخل رقم الناسخ">';
        html += '</div>';

        html += '<div class="form-group col-md-9">';
        html +=
            '<input list="copFontMatch" class="form-control" name="cop_fm'+e+'" id="cop_fm" placeholder="حدد الناسخ المشابه له في الخط '+e+'">';
        html += '<datalist id="copFontMatch">';
        html += '<?php for ($i = 0; $i <= $lastKey; $i++) { ?>';
        html += '<option value="<?php print_r($rows[$i][cop_id]); ?> # <?php print_r($rows[$i][full_name]); ?>">';
        html += '<?php  } ?>'
        html += '</datalist>';
        html += '</div>';

        $(html).insertBefore("#addFontMatch");
        $('#addFontMatch').css('margin-top', '5px');
        if (e == 5) $("#addFontMatch").remove();
        e++;
    }
});


// add copier - insertForm.php
var f = 2;
$("#addCopier").click(function () {
    if (f <= 4) {
        var html = '';
        html += '<div class="form-group col-md-5">';
        html +=
            '<input list="copiers" class="form-control" name="full_name'+f+'" id="full_name" placeholder="حدد اسم الناسخ '+f+'">';
        html += '<datalist id="copiers">';
        html += '<?php for ($i = 0; $i <= $lastKey; $i++) { ?>';
        html += '<option value="<?php print_r($rows[$i][cop_id]); ?> # <?php print_r($rows[$i][full_name]); ?>">';
        html += '<?php  } ?>'
        html += '</datalist>';
        html += '</div>';
        // name in manu
        html+= '<div class="form-group col-md-6">';
        html+= '<input type="text" class="form-control" name="name_in_manu'+f+'" id="name_in_manu" placeholder="أدخل اسم الناسخ '+f+' كما ورد في النسخة">';
        html+= '</div>';
        $(html).insertBefore("#addCopier");
        $('#addCopier').css('margin-top', '5px');
        if (f == 4) $("#addCopier").remove();
        f++;
    }
});


// add Motif
var g = 2;
$("#addMotif").click(function () {
    if (g <= 4) {
        var html = '';
        html += '<div class="form-group col-md-auto">';
        html += '<label for="motif">&nbsp;</label>';
        html +=
            '<input list="motifs" class="form-control" name="motif'+g+'" id="motif" placeholder="حدد الزخرفة '+g+'">';
        html += '<datalist id="motifs">';
        html += '<?php for ($i = 0; $i <= $lastMotifKey; $i++) { ?>';
        html += '<option value="<?php print_r($rowsMotif[$i][motif_id]); ?> # <?php print_r($rowsMotif[$i][motif_name]); ?>">';
        html += '<?php  } ?>';
        html += '</datalist>';
        html += '</div>';
        $(html).insertBefore("#addMotif");
        if (g == 4) $("#addMotif").remove();
        g++;
    }
});

// add inkColor
var h = 2;
$("#addInkColor").click(function () {
    if (h <= 4) {
        var html = '';
        html += '<div class="form-group col-md-auto">';
        html += '<label for="inkColor">&nbsp;</label>';
        html +=
            '<input list="inkColors" class="form-control" name="inkColor'+h+'" id="inkColor" placeholder="حدد اللون '+h+'">';
        html += '<datalist id="inkColors">';
        html += '<?php for ($i = 0; $i <= $lastColorKey; $i++) { ?>';
        html += '<option value="<?php print_r($rowsColor[$i][color_id]); ?> # <?php print_r($rowsColor[$i][color_name]); ?>">';
        html += '<?php  } ?>';
        html += '</datalist>';
        html += '</div>';
        $(html).insertBefore("#addInkColor");
        if (h == 4) $("#addInkColor").remove();
        h++;
    }
});

// add ManuTypes
var i = 2;
$("#addManuTypes").click(function () {
    if (i <= 4) {
        var html = '';
        html += '<div class="form-group col-md-auto">';
        html += '<label for="manu_type">&nbsp;</label>';
        html +=
            '<input list="manu_types" class="form-control" name="manu_types'+i+'" id="manu_type" placeholder="حدد العنصر '+i+'">';
        html += '<datalist id="manu_types">';
        html += '<?php for ($i = 0; $i <= $lastManuTypeKey; $i++) { ?>';
        html += '<option value="<?php print_r($rowsManuType[$i][type_id]); ?> # <?php print_r($rowsManuType[$i][type_name]); ?>">';
        html += '<?php  } ?>';
        html += '</datalist>';
        html += '</div>';
        $(html).insertBefore("#addManuTypes");
        if (i == 4) $("#addManuTypes").remove();
        i++;
    }
});

function scrollWin() {
    window.scrollBy(0, 200);
}

//*** add active class (works with links in one page) ***//
// $(".my_fixed_sidebar a").click(function() {
//     $('a').removeClass('active');
//     $(this).addClass("active");
// });

//*** remove row ***//
//$(document).on('click', '#removeRow', function () {
//    $(this).closest('#inputFormRow').remove();
//});

