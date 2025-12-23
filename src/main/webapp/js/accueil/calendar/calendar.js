import translate from "./translate.js";
import date_format from "./date_format.js";
import set_background from "./set_background.js";
import fetch_count from "./fetch_count.js";

const MONTH_NAMES = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];
const DAYS = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'];

window.app = app;
window.MONTH_NAMES = MONTH_NAMES;
window.DAYS = DAYS;

function app() {
	return {
		month: '',
		year: '',
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
			fetch_count(this.year, this.month);
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

		showEventModal(date) {
			// open the modal
			this.openEventModal = true;
			this.event_date = translate(new Date(this.year, this.month, date).toDateString());
		},

		addEvent() {
			console.log(date_format(this.event_date))

			const appointment_object = {
				id: {appointmentDate: date_format(this.event_date), appointmentTime: document.querySelector('.search-bar2').value},
				clientId: document.querySelector('.user-id').id
			}

			console.log(JSON.stringify(appointment_object));
			
			fetch("/sae/appointment/add-appointment", {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(appointment_object)
			})
			.then(answer => {
				if (answer.ok) {
					return answer.json();
				} else {
					console.error('Le fetch a posé un problème, answer n\'est pas ok.');
				}
			})
			.then(result => {
				if (result.error) {
					window.alert("Cette horaire a déjà été réservée.");
				} else {
					this.openEventModal = false;
					set_background(this.year, this.month, result.list);
				}
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
			fetch_count(this.year, this.month);
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
		}
	}
}