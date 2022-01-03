$(function () {

    window.onload = function () {
        submitSearch();
        companyNameSearch();
    };

    $(document).on('click', '.js-submit-search', function () {
        submitSearch();
    });

    $(document).on('click', '.js-search-company-name', function () {
        companyNameSearch();
    });

    var trackingId = $('#trackingId').val();
    var path = "company-search";

    function submitSearch() {
        var companyNameCondition = document.getElementById("companyNameCondition").value;
        var industryCondition = document.getElementById("industryCondition").value;
        var jobTypeCondition = document.getElementById("jobTypeCondition").value;
        var areaCondition = document.getElementById("areaCondition").selectedIndex;
        var industryList = document.getElementById("industryCondition");
        var jobList = document.getElementById("jobTypeCondition");
        var areaList = document.getElementById("areaCondition");
        var industry = industryList[industryCondition];
        var job = jobList[jobTypeCondition];
        var area = areaList[areaCondition];

        if (companyNameCondition || industryCondition || jobTypeCondition || areaCondition) {
            // 検索条件がある場合

            if (companyNameCondition) {

                if (industryCondition || jobTypeCondition || areaCondition) {
                    // フリーワード + カテゴリの検索の場合
                    searchCategory(areaCondition, industryCondition, jobTypeCondition, area, industry, job);
                } else {
                    // フリーワード検索の場合
                    document.title = companyNameCondition + "を含んだ企業検索結果一覧｜次世代の就活ならLinkT(リンクト) ";
                    document.querySelector("meta[name='description']").setAttribute('content',
                        "次世代型就活サイト【LinkT（リンクト）】に掲載されている"
                        + companyNameCondition
                        + "を含んだ企業情報一覧です。全国の企業の写真やPR動画を見て自由にメッセージ交換、オンライン面接を行うことができるLinkTであなたの就活を成功に導きます。");
                    path = "company-search"+"?"+"companyNameCondition"+"="+companyNameCondition;
                    gtag('config', trackingId, {'page_path': path});
                }

            } else {
                // フリーワード含んでいないカテゴリ検索の場合
                searchCategory(areaCondition, industryCondition, jobTypeCondition, area, industry, job);
            }
        } else {
            // 検索条件なしの場合
            document.title = "企業検索詳細｜LinkT(リンクト) - 新卒・第二新卒向けの次世代型就活サイト";
            document.querySelector("meta[name='description']").setAttribute('content',
                "新卒、第二新卒向けの就活・インターンサイト【LinkT（リンクト）】に掲載されている企業をお好みの条件で絞り込みできる検索詳細ページです。「フリーワード」「業種」「職種」「地域」で絞り込みができるので探している企業を簡単に見つけられます。")
        }
    }

    function companyNameSearch() {
        var companyNameCondition = document.getElementById("companyNameCondition").value;
        if (companyNameCondition) {
            // フリーワード検索の場合
            document.title = companyNameCondition + "を含んだ企業検索結果一覧｜次世代の就活ならLinkT(リンクト) ";
            document.querySelector("meta[name='description']").setAttribute('content',
                "次世代型就活サイト【LinkT（リンクト）】に掲載されている"
                + companyNameCondition
                + "を含んだ企業情報一覧です。全国の企業の写真やPR動画を見て自由にメッセージ交換、オンライン面接を行うことができるLinkTであなたの就活を成功に導きます。")
        } else {
            // 検索条件なしの場合
            document.title = "企業検索詳細｜LinkT(リンクト) - 新卒・第二新卒向けの次世代型就活サイト";
            document.querySelector("meta[name='description']").setAttribute('content',
                "新卒、第二新卒向けの就活・インターンサイト【LinkT（リンクト）】に掲載されている企業をお好みの条件で絞り込みできる検索詳細ページです。「フリーワード」「業種」「職種」「地域」で絞り込みができるので探している企業を簡単に見つけられます。")
        }
    }

    function searchCategory(areaCondition, industryCondition, jobTypeCondition, area, industry, job) {

        var titleTextEnd = "の求人がある企業情報一覧｜次世代の就活ならLinkT(リンクト) ";
        var descriptionTextStart = "次世代型就活サイト【LinkT（リンクト）】に掲載されている";
        var descriptionTextEnd = "の求人がある企業情報一覧です。全国の企業の写真やPR動画を見て自由にメッセージ交換、オンライン面接を行うことができるLinkTであなたの就活を成功に導きます。";
        var textContent = null;
        var companyNameCondition = document.getElementById("companyNameCondition").value;

        if (areaCondition) {
            // エリア検索がある場合
            if (industryCondition && jobTypeCondition) {
                // 業種、職種検索がある場合
                textContent = area.innerHTML + "の" + industry.innerHTML + "、" + job.innerHTML;
                getTitle(textContent, titleTextEnd);
                getDescription(descriptionTextStart, textContent, descriptionTextEnd);
                if (companyNameCondition) {
                    path = "company-search"+"/industryCondition/"+industryCondition+"/jobTypeCondition/"+jobTypeCondition+"/areaCondition/"+areaCondition+"?"+"companyNameCondition"+"="+companyNameCondition;
                    gtag('config', trackingId, {'page_path': path});
                }else {
                    path = "company-search"+"/industryCondition/"+industryCondition+"/jobTypeCondition/"+jobTypeCondition+"/areaCondition/"+areaCondition;
                    gtag('config', trackingId, {'page_path': path});
                }
            } else if (industryCondition) {
                // エリア検索、業種検索の場合
                textContent = area.innerHTML + "の" + industry.innerHTML;
                getTitle(textContent, titleTextEnd);
                getDescription(descriptionTextStart, textContent, descriptionTextEnd);
                if(companyNameCondition){
                    path = "company-search"+"/industryCondition/"+industryCondition+"/areaCondition/"+areaCondition+"?"+"companyNameCondition"+"="+companyNameCondition;
                    gtag('config', trackingId, {'page_path': path});
                }else {
                    path = "company-search"+"/industryCondition/"+industryCondition+"/areaCondition/"+areaCondition;
                    gtag('config', trackingId, {'page_path': path});
                }
            } else if (jobTypeCondition) {
                // エリア検索、職種検索の場合
                textContent = area.innerHTML + "の" + job.innerHTML;
                getTitle(textContent, titleTextEnd);
                getDescription(descriptionTextStart, textContent, descriptionTextEnd);
                if (companyNameCondition) {
                    path = "company-search"+"/jobTypeCondition/"+jobTypeCondition+"/areaCondition/"+areaCondition+"?"+"companyNameCondition"+"="+companyNameCondition;
                    gtag('config', trackingId, {'page_path': path});
                }else {
                    path = "company-search"+"/jobTypeCondition/"+jobTypeCondition+"/areaCondition/"+areaCondition;
                    gtag('config', trackingId, {'page_path': path});
                }
            } else {
                // エリア検索のみの場合
                textContent = area.innerHTML;
                getTitle(textContent, titleTextEnd);
                getDescription(descriptionTextStart, textContent, descriptionTextEnd);
                if(companyNameCondition){
                    path = "company-search"+"/areaCondition/"+areaCondition+"?"+"companyNameCondition"+"="+companyNameCondition;
                    gtag('config', trackingId, {'page_path': path});
                }else {
                    path = "company-search"+"/areaCondition/"+areaCondition;
                    gtag('config', trackingId, {'page_path': path});
                }
            }
        } else {
            // エリア検索がない場合
            if (industryCondition && jobTypeCondition) {
                // 業種、職種検索がある場合
                textContent = industry.innerHTML + "、" + job.innerHTML;
                getTitle(textContent, titleTextEnd);
                getDescription(descriptionTextStart, textContent, descriptionTextEnd);
                if (companyNameCondition){
                    path = "company-search"+"/industryCondition/"+industryCondition+"/jobTypeCondition/"+jobTypeCondition+"?"+"companyNameCondition"+"="+companyNameCondition;
                    gtag('config', trackingId, {'page_path': path});
                } else {
                    path = "company-search"+"/industryCondition/"+industryCondition+"/jobTypeCondition/"+jobTypeCondition;
                    gtag('config', trackingId, {'page_path': path});
                }
            } else if (industryCondition) {
                // 業種検索のみの場合
                textContent = industry.innerHTML;
                getTitle(textContent, titleTextEnd);
                getDescription(descriptionTextStart, textContent, descriptionTextEnd);
                if (companyNameCondition){
                    path = "company-search"+"/industryCondition/"+industryCondition+"?"+"companyNameCondition"+"="+companyNameCondition;
                    gtag('config', trackingId, {'page_path': path});
                } else {
                    path = "company-search"+"/industryCondition/"+industryCondition;
                    gtag('config', trackingId, {'page_path': path});
                }
            } else if (jobTypeCondition) {
                // 職種検索のみの場合
                textContent = job.innerHTML;
                getTitle(textContent, titleTextEnd);
                getDescription(descriptionTextStart, textContent, descriptionTextEnd);
                if (companyNameCondition) {
                    path = "company-search"+"/jobTypeCondition/"+jobTypeCondition+"?"+"companyNameCondition"+"="+companyNameCondition;
                    gtag('config', trackingId, {'page_path': path});
                }else {
                    path = "company-search"+"/jobTypeCondition/"+jobTypeCondition;
                    gtag('config', trackingId, {'page_path': path});
                }
            }
        }
    }

    function getTitle(textContent, titleTextEnd) {
        document.title = textContent + titleTextEnd;
    }

    function getDescription(descriptionTextStart, textContent, descriptionTextEnd) {
        document.querySelector("meta[name='description']").setAttribute('content',
            descriptionTextStart + textContent + descriptionTextEnd);
    }

    gtag('config', trackingId, {'page_path': path});

/* 文字数制限・省略表示
--------------------------------------------- */
    $('.result__company__body p:last-child').each(function() {
        if ($(this).text().length > 90) {
            $(this).text($(this).text().substr(0, 89));
            $(this).append('...');
        }
    });

});
