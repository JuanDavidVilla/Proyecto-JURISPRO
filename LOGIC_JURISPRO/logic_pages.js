document.querySelector('.ClassForm').addEventListener('submit', function (event_send){

        event_send.preventDefault();

        const input_name = document.getElementById('name').value
        const input_card = document.getElementById('ID_card').value;
        const input_phone = document.getElementById('phone').value;
        const input_info = document.getElementById('info').value;


        fetch("../LOGIC_JURISPRO/controller.php",{

            method: 'POST',
            headers: {'Content-Type': 'application/json'},

            body: JSON.stringify({

                input_name,
                input_card,
                input_phone,
                input_info,
            })

            
        
        })

        .then (response => response.json())

        .then(data => {alert(data.message)})

        .catch(error => console.error("Error:", error))
})
