const app = new Vue({
    el: '#app',
    data: {},
    methods: {
        async likeMember(index, students, companyId) {
            const student = students[index]
            const member_id = parseInt(student.id);
            const company_id = parseInt(companyId);
            const like_id = parseInt(student.checkLikeOrNotId || 0);
            const like_status = parseInt(student.checkLikeOrNotStatus || 0);
            const new_like_status = like_status === 0 || like_status === 10 ? 20 : 10
            const data = {
                member_id : member_id,
                company_id : company_id,
                like_id : like_id,
                like_status : new_like_status
            }
            try {
                const result = await axios.post("/business/like-member", data)
                student.checkLikeOrNotId = result.data.id
                student.checkLikeOrNotStatus = new_like_status
                students.splice(index, 1, student)
            } catch(error) {
                alert("エラーが発生いたしました。もう一度お試しください。")
            }
        },
    },
})
