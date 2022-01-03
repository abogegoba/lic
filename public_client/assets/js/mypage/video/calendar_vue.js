new Vue({
	el:"#app",
    data:{
        today:"",
        selectedMonth:"",
        selectedDay:"",
        currentYear:0,
        currentMonth:0,
        currentDate:0,
        months:[...Array(12).keys()].map(i => ++i),
        weeks:["日","月","火","水","木","金","土"],
        isOpen: false,
        isMore: false,
        isAcc: false,
        isDiff: false,
        selectedUserId: "",
        selectDay: 0,
        diffDay: 0,
    },
    created(){
        const date  = new Date();
        [this.currentYear,  this.currentMonth, this.currentDate] = [date.getFullYear(), date.getMonth() + 1, date.getDate()];
        this.selectedMonth = `${('0' + this.currentMonth).slice(-2)}`;
        this.today = this.selectedDay = `${this.currentYear}-${('0' + this.currentMonth).slice(-2)}-${('0' + this.currentDate).slice(-2)}`;

        this.formattedInterviewAppointmentList = $('#reservation').data(
            'data'
        )
            ? Object.values($('#reservation').data('data'))
            : []

        this.formattedVideoCallHistoryList = $('#history').data(
            'data'
        )
            ? Object.values($('#history').data('data'))
            : []
    },
    methods:{
        checkSelectedMonth(month){
            return {
                'selectedMonth':`${('0' + month).slice(-2)}` == this.selectedMonth
            }
        },
        checkToday(month, day){
            return {
                'selectedDay':`${this.currentYear}-${('0' + month).slice(-2)}-${('0' + day).slice(-2)}` == this.today
            }
        },
        checkSelectedWeek(date){
            return {
                'Sun': date == '0',
                'Sat': date == '6'
            }
        },
        moveMonth: function (month) {
            this.currentMonth = this.selectedMonth = month;
            this.currentDate = 0;
        },
        moveDay: function(day) {
            this.currentDate = day;
        },
        prevYear: function() {
            this.currentYear = this.currentYear - 1;
            this.currentDate = 0;
        },
        nextYear: function() {
            this.currentYear = this.currentYear + 1;
            this.currentDate = 0;
        },
        toggleModal: function(id, bool) {
            if(id !== this.selectedUserId && bool) {
                this.selectedUserId = id;
                this.isOpen = bool;
            } else if(id === this.selectedUserId && !bool) {
                this.selectedUserId = "";
                this.isOpen = bool;
            }
        },
        toggleMore: function(day, bool) {
            if(day !== this.selectDay && bool) {
                this.selectDay = day;
                this.isMore = bool;
            } else if(day === this.selectDay && !bool) {
                this.selectDay = "";
                this.isMore = bool;
                if(this.isOpen) {
                    this.selectedUserId = "";
                    this.isOpen = false;
                }
            }
        },
        toggleAccordion: function(day) {
            if(day !== this.currentDate) {
                this.currentDate = day;
                if(!this.isAcc) {
                    this.isAcc = !this.isAcc;
                }
            } else if(day === this.currentDate && this.isAcc) {
                this.currentDate = 0;
                this.isAcc = !this.isAcc;
            }
        },
        getPlansAppointmentList: function(Day) {
            const array = [];
            const currentDate = `${this.currentYear}${this.currentMonth}${Day}`;

            this.formattedInterviewAppointmentList.forEach((data) => {
                const {appointmentYear, appointmentMonth, appointmentDay } = data;
                const appointmentDate = `${appointmentYear}${appointmentMonth}${appointmentDay}`;
                if(appointmentDate === currentDate) {
                    array.push(data);
                }
            })
            return array;
        },
        getHistoryDayList: function(Day){
            const array = [];
            const getCurrentDate = `${this.currentYear}${this.currentMonth}${Day}`;

            this.formattedVideoCallHistoryList.forEach((data) => {
                const {startYear, startMonth, startDay} = data;
                const historyDate = `${startYear}${startMonth}${startDay}`;

                if(historyDate === getCurrentDate) {
                    array.push(data);
                }
            })
            return array;
        },
        getHistoryList: function() {
            const array = [];
            const getCurrentMonth = `${this.currentYear}${this.currentMonth}`;
            let checkDay = 0;

            this.formattedVideoCallHistoryList.forEach((data) => {
                const {startYear, startMonth, startDay, startDate} = data;
                const historyMonth = `${startYear}${startMonth}`;

                if(historyMonth == getCurrentMonth) {
                    if(checkDay != startDay) {
                        const daysList = this.getHistoryDayList(startDay)
                        const obj = {
                            "year": startYear,
                            "month": startMonth,
                            "day": startDay,
                            "date": startDate,
                            "list": daysList
                        }
                        array.push(obj);
                        checkDay = startDay;
                    }
                }
            })
            return array;
        },
        getPlansMoreNum: function(Day) {
            let num = 0;
            const currentDate = `${this.currentYear}${this.currentMonth}${Day}`;

            this.formattedInterviewAppointmentList.forEach((data) => {
                const {appointmentYear, appointmentMonth, appointmentDay } = data;
                const appointmentDate = `${appointmentYear}${appointmentMonth}${appointmentDay}`;
                if(currentDate === appointmentDate) {
                    num++;
                }
            })
            return num;
        }
    },
    computed:{
        calendarMake: function () {
        // 戻り値用配列
        const calender = [];
        const currentYear =  this.currentYear;
        const currentMonth =  this.currentMonth;
        // 現在の月の初日の曜日
        const currentFirstWeek = new Date(currentYear, currentMonth - 1, 1).getDay();
        // 現在の月の最終日のDate型
        const currentLastDate = new Date(currentYear, currentMonth, 0);
        // 前月の最終日の日付
        const prevLastDay = new Date(currentYear, currentMonth - 1, 0).getDate();
        // 前月分の空白数
        const necessarySpacePrev = currentFirstWeek;
        // 来月分の空白数
        const necessarySpaceAfter = 6 - currentLastDate.getDay();
        // 前月分の先頭日付
        const prevLeadDay = prevLastDay - (necessarySpacePrev - 1);
        // 各月毎のカレンダー日付配列
        const dayList = [[...Array(necessarySpacePrev)].map((_, i) => prevLeadDay+i), [...Array(currentLastDate.getDate())].map((_, i) => i+1), [...Array(necessarySpaceAfter)].map((_, i) => i+1)];
        // 上記統合したカレンダー日付配列
        const calenderDayList = dayList.reduce((pre,current) => {pre.push(...current);return pre},[]);
        // 前月分の先頭日のDate型
        const prevLeadDate = new Date(currentYear, currentMonth - 2, prevLeadDay);

        calenderDayList.forEach((calenderDay) => {
            const obj = {
                'value': calenderDay,
                'thisMonth': prevLeadDate.getMonth() +1,
                'thisWeek': prevLeadDate.getDay()
            }
            calender.push(obj);
            prevLeadDate.setDate(prevLeadDate.getDate() + 1);
        })

        return calender;
        },
    }
});