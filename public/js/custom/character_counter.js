document.addEventListener("DOMContentLoaded", function() {
        let textarea = document.getElementById("feedbackdescription");
        let counter_description = document.getElementById("feedback_description_character_counter");
        
    
        textarea.addEventListener("input", function() {
            let remaining_description = 10000 - textarea.value.length;
            counter_description.textContent = "Characters remaining: " + remaining_description;
            if (remaining_description < 0) {
                counter_description.classList.remove("text-success");
                counter_description.classList.add("text-danger");
            }
            else {
                counter_description.classList.remove("text-danger");
                counter_description.classList.add("text-success");
            }
        });
});