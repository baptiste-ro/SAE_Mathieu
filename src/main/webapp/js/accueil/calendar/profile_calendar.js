import translate from "./translate.js";
import date_format from "./date_format.js";
import set_background from "./set_background.js";
import fetch_count from "./fetch_count.js";
import switch_calendar from "./switch_calendar.js";

const monthly = document.querySelector(".monthly_calendar");
const daily = document.querySelector(".daily_calendar");
const container = document.querySelector(".calendar-container");

const user_id = document.querySelector(".profile_id");

const MONTH_NAMES = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
const DAYS = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];

window.app = app;
window.MONTH_NAMES = MONTH_NAMES;
window.DAYS = DAYS;

function app() {
	return {
		month: '',
		year: '',
		dayNumber: '',
        time: '',
		nb_of_appointments: 0,
		background: "white__",
		no_of_days: [],
		blankdays: [],
		days: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
		event_title: '',
		event_date: '',
		event_theme: 'blue',

		themes: [
			{
				value: "blue",
				label: "Blue Theme"
			},
			{
				value: "red",
				label: "Red Theme"
			},
			{
				value: "yellow",
				label: "Yellow Theme"
			},
			{
				value: "green",
				label: "Green Theme"
			},
			{
				value: "purple",
				label: "Purple Theme"
			}
		],

		openEventModal: false,

		initDate() {
			let today = new Date();
			this.month = today.getMonth();
			this.year = today.getFullYear();
			this.datepickerValue = new Date(this.year, this.month, today.getDate()).toDateString();
		},

		getBackground() {
			if (this.nb_of_appointments < 4) {
				return "white__";
			} else if (this.nb_of_appointments < 9) {
				return "light_yellow__";
			} else if (this.nb_of_appointments < 14) {
				return "orange__";
			} else if (this.nb_of_appointments < 19) {
				return "red_orange__";
			} else if (this.nb_of_appointments < 23) {
				return "red";
			} else if (this.nb_of_appointments < 26) {
				return "dark_red__";
			} else {
				return "black__";
			}
		},

		isToday(date) {
			const today = new Date();
			const d = new Date(this.year, this.month, date);
			return today.toDateString() === d.toDateString() ? true : false;
		},

        getCurrentDayAppointments() {
            fetch(`/sae/appointment/get-user-appointment/${user_id.id}/${this.parsableDateFormat(`${this.year}-${this.month+1}-${this.dayNumber}`)}`)
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    console.error("Une erreur s'est produite lors de la tentative de récuparation des rendez-vous.");
                    console.error(response.text());                    
                }
            })
            .then(answer => {
                console.log(answer);
                document.querySelectorAll(".row_").forEach(elt => {
                    elt.innerHTML = "";
                })
                answer.forEach(elt => {
                    const t = this.correctTimeFormat(elt);
                    const s = t.split(":");
                    const div = document.querySelector(`#_${s[0]}h${s[1]}`);
                    // const randomColor = "#"+((1<<24)*Math.random()|0).toString(16); style="background-color: ${randomColor}"
                    div.innerHTML = `<div class="rdv"
                                            @click="showProfileModal('${t}')">
                                            ${s[0]}h${s[1]} - ${s[1] == "30" ? (parseInt(s[0]) + 1 < 10 ? "0" + (parseInt(s[0]) + 1) : parseInt(s[0]) + 1) : s[0]}h${s[1] == "30" ? "00" : "30"} : Validé
                                        </div>`
                });
            })
        },

        parsableDateFormat(date) {
            const date_split = date.split("-");
            return `${date_split[0]}-${(date_split[1].length == 1 ? "0" + date_split[1] : date_split[1])}-${date_split[2]}`;
        },

        correctTimeFormat(t) {
            const s = t.split(":");
            return `${s[0]}:${s[1]}`;
        },

		switchOnCalendar(date) {
			this.event_date = translate(new Date(this.year, this.month, date).toDateString());
			this.dayNumber = date;
			switch_calendar(daily, monthly, container);
            this.getCurrentDayAppointments();
		},

		switchOffCalendar() {
			switch_calendar(daily, monthly, container);
		},

		showProfileModal(time) {
			this.openEventModal = true;
            this.time = time;
            console.log(this.time)
		},

		showEventModal(date) {
			// open the modal
			this.event_date = translate(new Date(this.year, this.month, date).toDateString());
			this.openEventModal = true;
		},

        deleteEvent() {
            const appointment_object = {
				id: {appointmentDate: date_format(this.event_date), appointmentTime: this.time},
				cid: user_id.id
			}

            fetch("/sae/appointment/delete-appointment", {
                method: 'POST',
                headers: {
                    'Content-Type' : 'application/json'
                },
                body: JSON.stringify(appointment_object)
            })
            .then(response => {
                if (response.ok) {
                    return response.text();
                } else {
                    console.error("Is not ok");
                    
                }
            })
            .then(data => {
                console.log(data);
                this.getCurrentDayAppointments();
                this.openEventModal = !this.openEventModal;
            })
        },

		prevMonth() {
			if (this.month === 0) {
				this.month = 11;
				this.year--;
			} else {
				this.month--;
			}
			this.getNoOfDays();
			fetch_count(this.year, this.month, 0);
		},

		nextMonth() {
			if (this.month === 11) {
				this.month = 0;
				this.year++;
			} else {
				this.month++;
			}
			this.getNoOfDays();
			fetch_count(this.year, this.month);
		},

		prevDay() {
			if (this.dayNumber == 1) {
				this.prevMonth();
				this.dayNumber = new Date(this.year, this.month + 1, 0).getDate();
			} else {
				this.dayNumber = this.dayNumber - 1;
			}
			this.event_date = translate(new Date(this.year, this.month, this.dayNumber).toDateString());
            this.getCurrentDayAppointments();
		},

		nextDay() {
			if (this.dayNumber == new Date(this.year, this.month + 1, 0).getDate()) {
				this.nextMonth();
				this.dayNumber = 1;
			} else {
				this.dayNumber = this.dayNumber + 1;
			}
			this.event_date = translate(new Date(this.year, this.month, this.dayNumber).toDateString());
            this.getCurrentDayAppointments();
		},


		getNoOfDays() {
			let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

			// find where to start calendar day of week
			let dayOfWeek = new Date(this.year, this.month).getDay();
			let blankdaysArray = [];
			for ( var i=1; i <= dayOfWeek; i++) {
				blankdaysArray.push(i);
			}

			let daysArray = [];
			for ( var i=1; i <= daysInMonth; i++) {
				daysArray.push(i);
			}

			this.blankdays = blankdaysArray;
			this.no_of_days = daysArray;
		},

		sendRedirect() {
			window.location.href = "/sae/Connexion.jsp"
		}
	}
}