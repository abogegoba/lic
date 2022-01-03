const app = new Vue({
    el: '#app',
    data: {
        exchangeUserAccountInformationList: [],
        displayExchangeUserAccountInformationList: [],
        loggedInUserAccountId: null,
        filterWord: ''
    },
    created: function() {
        this.exchangeUserAccountInformationList = $('#message_list_modal').data(
            'data'
        )
            ? Object.values($('#message_list_modal').data('data'))
            : []
        this.loggedInUserAccountId = $('#message_list_modal').data(
            'logged-in-user-account-id'
        )
        moment.locale('ja') // ここで設定しない場合、曜日表記が英語になる
        this.exchangeUserAccountInformationList = this.exchangeUserAccountInformationList.map(
            (v) => {
                // Sort用に加工前のデータを保持
                v.contributionDatetimeOrigin = v.contributionDatetime
                const contributionDatetime = moment(v.contributionDatetime)
                // JSTに変換
                const today = moment()
                if (
                    contributionDatetime.year() === today.year()
                    && contributionDatetime.month() === today.month()
                    && contributionDatetime.date() === today.date()
                ) {
                    v.contributionDatetime = contributionDatetime.format('HH:mm')
                } else if(today.diff(contributionDatetime, 'days') === 1) {
                    v.contributionDatetime = '昨日'
                } else if(today.diff(contributionDatetime, 'days') < 7) {
                    v.contributionDatetime = contributionDatetime.format('dddd');
                } else {
                    v.contributionDatetime = contributionDatetime.format('YYYY/M/D');
                }
                return v
            }
        )
        // deep copy
        this.displayExchangeUserAccountInformationList = JSON.parse(
            JSON.stringify(this.exchangeUserAccountInformationList)
        )
        this.sortByRecieved(false)

        const $container = $(".message-detail")[0]
        $("html,body").animate({scrollTop: $container.scrollHeight}, 100, 'swing');
    },
    methods: {
        sortByRecieved(asc = true) {
            this.filterWord = ''
            const originalUserAccountInformationList = JSON.parse(
                JSON.stringify(this.exchangeUserAccountInformationList)
            )
            originalUserAccountInformationList.sort(function(a, b) {
                if (
                    Date.parse(b.contributionDatetimeOrigin) >
                    Date.parse(a.contributionDatetimeOrigin)
                ) {
                    return asc ? -1 : 1
                } else {
                    return asc ? 1 : -1
                }
            })
            this.displayExchangeUserAccountInformationList = originalUserAccountInformationList
        },
        sortByAlreadyRead() {
            // まず日付降順ソート
            this.sortByRecieved(false)
            const notAlreadyReadMessages = this.displayExchangeUserAccountInformationList.filter(
                (message) => {
                    return (
                        message.latestMessageSendingUserAccountId !==
                            this.loggedInUserAccountId && !message.alreadyRead
                    )
                }
            )
            console.log(notAlreadyReadMessages)
            const alreadyReadMessages = this.displayExchangeUserAccountInformationList.filter(
                (message) => {
                    return !(
                        message.latestMessageSendingUserAccountId !==
                            this.loggedInUserAccountId && !message.alreadyRead
                    )
                }
            )
            this.displayExchangeUserAccountInformationList = notAlreadyReadMessages.concat(
                alreadyReadMessages
            )
        }
    },
    watch: {
        filterWord(val) {
            if (!val) {
                this.sortByRecieved(false)
                return
            }
            const originalUserAccountInformationList = JSON.parse(
                JSON.stringify(this.exchangeUserAccountInformationList)
            )
            this.displayExchangeUserAccountInformationList = originalUserAccountInformationList.filter(
                (x) => x.companyName.includes(val)
            )
        }
    }
})
