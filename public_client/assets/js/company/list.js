$(function () {

    window.onload = function () {
        submitSearch();
        searchKeyword();
    };

    $(document).on('click', '.js-submit-search', function () {
        if (
            !document.getElementById("keywordCondition").value
            && !document.getElementById("undergraduateCourseCondition").value
            && !document.getElementById("industryCondition").value
            && !document.getElementById("areaCondition").value
            && !document.getElementById("graduationPeriodYear").value
            && !document.getElementById("graduationPeriodMonth").value
        ) {
            $('.condition_error').show()
            event.preventDefault()
            return
        }
        $('.condition_error').hide();
        submitSearch();
    });

    $(document).on('click', '.js-submit-search-overseas', function () {
        if (
            !document.getElementsByClassName("undergraduate_course_condition")[0].value
            && !document.getElementsByClassName("industry_condition")[0].value
            && !document.getElementsByClassName("area_condition")[0].value
        ) {
            $('.condition_error').show()
            event.preventDefault()
            return
        }
        $('.condition_error').hide();
        submitSearch();
    });

    $(document).on('click', '.js-search-keyword', function () {
        searchKeyword();
    });

    function submitSearch() {
        var keywordCondition  = document.getElementById("keywordCondition").value;
        var undergraduateCourseCondition  = document.getElementById("undergraduateCourseCondition").value;
        var industryCondition  = document.getElementById("industryCondition").value;
        var areaCondition  = document.getElementById("areaCondition").value;
        var undergraduateCourseList  = document.getElementById("undergraduateCourseCondition");
        var industryList  = document.getElementById("industryCondition");
        var areaList = document.getElementById("areaCondition");
        var undergraduateCourse = undergraduateCourseList[undergraduateCourseCondition];
        var industry = industryList[industryCondition];
        var area = areaList[areaCondition];

        if (keywordCondition || undergraduateCourseCondition || industryCondition || areaCondition) {
            // 検索条件がある場合

            if (keywordCondition) {

                if (undergraduateCourseCondition || industryCondition || areaCondition) {
                    // フリーワード + カテゴリの検索の場合
                    searchCategory(areaCondition, industryCondition, undergraduateCourseCondition, area, industry, undergraduateCourse);
                } else {
                    // フリーワード検索の場合
                    document.title = keywordCondition + "を含んだ学生一覧｜新卒・第二新卒採用ならLinkT(リンクト) ";
                }

            } else {
                // フリーワード含んでいないカテゴリ検索の場合
                searchCategory(areaCondition, industryCondition, undergraduateCourseCondition, area, industry, undergraduateCourse);
            }
        } else {
            // 検索条件なしの場合
            document.title = "学生検索詳細｜LinkT(リンクト) - 次世代型新卒・第二新卒採用サービス";
        }
    }

    function searchKeyword() {
        var keywordCondition  = document.getElementById("keywordCondition").value;
        if (keywordCondition) {
            // フリーワード検索の場合
            document.title = keywordCondition + "を含んだ学生一覧｜新卒・第二新卒採用ならLinkT(リンクト) ";
        } else {
            document.title = "学生検索詳細｜LinkT(リンクト) - 次世代型新卒・第二新卒採用サービス";
        }
    }

    function searchCategory(areaCondition, industryCondition, undergraduateCourseCondition, area, industry, undergraduateCourse) {

        var titleTextEnd = "の学生一覧｜新卒・第二新卒採用ならLinkT(リンクト) ";
        var textContent = null;

        if (undergraduateCourseCondition) {
            // 学部系統検索がある場合
            textContent = undergraduateCourse.innerHTML;
            getTitle(textContent, titleTextEnd);
            if (industryCondition && areaCondition) {
                // 希望業種、希望勤務地検索がある場合
                textContent = undergraduateCourse.innerHTML + "の" + industry.innerHTML + "、" + area.innerHTML;
                getTitle(textContent, titleTextEnd);
            } else if (industryCondition) {
                // 学部系統検索、希望業種検索の場合
                textContent = undergraduateCourse.innerHTML + "の" + industry.innerHTML;
                getTitle(textContent, titleTextEnd);
            } else if (areaCondition) {
                // 学部系統検索、希望勤務地検索の場合
                textContent = undergraduateCourse.innerHTML + "の" + area.innerHTML;
                getTitle(textContent, titleTextEnd);
            } else {
                // 学部系統検索のみの場合
                textContent = undergraduateCourse.innerHTML;
                getTitle(textContent, titleTextEnd);
            }
        } else {
            // 学部系統検索がない場合
            if (industryCondition && areaCondition) {
                // 希望業種、希望勤務地検索がある場合
                textContent = industry.innerHTML + "、" + area.innerHTML;
                getTitle(textContent, titleTextEnd);
            } else if (industryCondition) {
                // 希望業種検索のみの場合
                textContent = industry.innerHTML;
                getTitle(textContent, titleTextEnd);
            } else if (areaCondition) {
                // 希望勤務地検索のみの場合
                textContent = area.innerHTML;
                getTitle(textContent, titleTextEnd);
            }
        }

        function getTitle(textContent, titleTextEnd) {
            document.title = textContent + titleTextEnd;
        }
    }
});