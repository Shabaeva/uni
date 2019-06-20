import $ from 'jquery';

class MyNotes{
	consrtuctor(){
		this.events();
	}
	events(){
		$(".delete-note").on("click", this.deleteNote);
	}
	//Method will go here
	deleteNote(){
		$.ajax({
			beforeSend: (xhr) => {
				xhr.setRequestHeader('X-WP-Nonce', uniData.nonce);
			},
			url: uniData.root_url + '/wp/json/wp/v2/note/123',
			type: 'DELETE',
			success: (response) => {
			 console.log("Congrats");
			 console.log(response);
			},
			error: (response) => {
			 console.log("Sorry");
			 console.log(response);
			}
		});
	}
}

export default MyNotes;