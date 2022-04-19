

class Tarea {
  constructor(){

    //--------------------------------------------------------------------------
    // EJ 1
    //--------------------------------------------------------------------------

    const objYT = {
    		id: '_u0bH9joTfg',
    		autoplay: '0',
    		w: '90%',
    		h: '300px',
    		class: 'in',
    		style: 'margin: auto;'
    	};

    append('body', `

    <style>
      h1 {
        padding: 20px;
        color: white;
        background: green;
      }
      h2 {
        padding: 10px;
        color: white;
        background: green;
      }
    </style>

    <div class='in' style='max-width: 600px; margin: auto'>

              <h1 class='inl'>instituto profesional Estudia AquÍ</h1>

              <h2 class='inl'>Quiénes somos</h2>

              <iframe style='`+objYT.style+`' width='`+objYT.w+`' height='`+objYT.h+`' class='`+objYT.class+`'
              src='https://www.youtube.com/embed/`+objYT.id+`?autoplay=`+objYT.autoplay+`'
              frameborder='0'
              allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen>
              </iframe>

    </div>

    `);

    //--------------------------------------------------------------------------
    // EJ 2
    //--------------------------------------------------------------------------

    append('body', `

    <style>
      .img-gallery {
        background: green;
        padding: 10px;
        width: 90%;
        max-width: 500px;
        margin: auto;
      }
    </style>

    <h2> Galeria <h2>

  `+[
    "https://www.iacc.cl/wp-content/uploads/2021/08/insttucion.jpg",
    "https://www.iacc.cl/wp-content/uploads/2020/09/IACC1.jpg",
    "https://www.iacc.cl/wp-content/uploads/2018/12/Frontis-IACC-1-e1587062523608.jpg"
  ].map(srcImg => `
        <img class='in img-gallery' src='`+srcImg+`'>
    `).join(''));


    //--------------------------------------------------------------------------
    // EJ 3
    //--------------------------------------------------------------------------

    append('body', `
      <h2> Encuesta </h2>
      <style>
       form {
          max-width: 600px;
          width: 90%;
          margin: auto;
          padding: 10px;
          background: green;
          color: white;
       }
      </style>
      <form class='in'>

      </form>
    `);
    // renderizado inputs
    const inputs = [
      { name: "nombre_completo", type: 'text' },
      { name: "fecha_de_nacimiento", type: 'date' },
      { name: "dirección", type: 'text' },
      { name: "ciudad", type: 'text' },
      { name: "telefono", type: 'text' },
      { name: "email", type: 'email'}
    ];
    inputs.map(inputName => append('form', renderInput({
        underpostClass: 'in',
        id_content_input: makeid(5),
        id_input: inputName.name,
        type: inputName.type,
        required: true,
        style_content_input: '',
        style_input: 'color: black; font-size: 16px; padding: 10px',
        style_label: '',
        style_outline: true,
        style_placeholder: 'color: green',
        textarea: false,
        active_label: false,
        initLabelPos: 15,
        endLabelPos: -30,
        text_label: '',
        tag_label: makeid(5),
        fnOnClick: async () => {
          console.log('click input');
        },
        value: ``,
        topContent: inputName.type == 'date' ? cap(inputName.name.replaceAll('_', ' ')) : '',
        botContent: '<br>',
        placeholder: cap(inputName.name.replaceAll('_', ' '))
      })));


    append('form', renderDropDownV1({
      title: 'Seleccione tipo de Horario',
      id: "tipo_horario",
      underpostClass: 'in',
      style: {
        content: 'font-size: 14px; padding: 10px;',
        option: 'font-size: 14px; padding: 10px;'
      },
      data: [
        {
          value: 'Diurno',
          display: 'Diurno'
        },
        {
          value: 'Vespertino',
          display: 'Vespertino'
        }
      ]
    }));
    // renderizado boton enviar
    append('form', `
    <br>
        <style>
        .send-form {
          cursor: pointer;
          padding: 15px;
          color: green;
          background: white;
        }
        </style>
        <div class='inl send-form'>
            ENVIAR
        </div>

    `);
    // evento enviar
    s('.send-form').onclick = () => {
      let obj = {};
      inputs.map(inputName => {
        obj[inputName.name] = s('.'+inputName.name).value;
      });
      obj["tipo_horario"] = s('.tipo_horario').value;
      console.log('send form ->');
      console.log(jsonSave(obj));
    }

    //--------------------------------------------------------------------------
    //--------------------------------------------------------------------------

    append('body', spr('<br>', 5))

  }
}


new Tarea();
