
import { Rest } from '../underpost-library/mods/rest.js';


class Shop {

  constructor(){

    // se carga un componete para notificar al usuario
    // exitos o errores en la operacion de compra
    const fontSizeNotifiIcon = 18;
    const fontSizeNotifi = 18;
    notifi.load({
           AttrRender: {
             error: `

                  <span style='font-size: `+fontSizeNotifiIcon+`px; font-weight: bold; color: red;'>error</span>

             `,
             success: `

                <span style='font-size: `+fontSizeNotifiIcon+`px; font-weight: bold; color: green;'>exito</span>

             `
           },
           style: {
             notifiValidator: `
             border-radius: 10px;
             /* border: 2px solid yellow; */
             color: white;
             font-size: `+fontSizeNotifi+`px;
             z-index: 9999;
             height: 50px;
             transform: translate(-50%, 0);
             bottom: 10px;
             left: 50%;
             width: 300px;
             `,
             notifiValidator_c1: `
             width: 80px;
             height: 100%;
             /* border: 2px solid blue; */
             top: 0%;
             left: 0%;
             `,
             notifiValidator_c2: `
             height: 100%;
             /* border: 2px solid blue; */
             top: 0%;
             left: 80px;
             width: 220px;
             `

           }
         });

    const sizeTitle = 15;
    const backgroundNotifi = 'rgba(0, 0, 0, 0.9)';

    // return   notifi.display(
    //    backgroundNotifi,
    //    'Empty title',
    //    2000,
    //    'error'
    //  );

    // se renderizar el formulario
    append('body', renderInput({
      underpostClass: 'in',
      id_content_input: 'a1',
      id_input: 'underpost-ql-title',
      type: 'text',
      required: true,
      style_content_input: '',
      style_input: `

          padding: 12px 15px;
          font-size: `+sizeTitle+`px;
          background: black;
          color: white;

      `,
      style_label: 'color: red; font-size: 12px;',
      style_outline: true,
      style_placeholder: 'font-style: italic;',
      textarea: false,
      active_label: false,
      initLabelPos: 3,
      endLabelPos: -25,
      text_label: 'Nombre',
      tag_label: 'a3',
      fnOnClick: async () => {
        console.log('click input');
      },
      value: ``,
      topContent: '',
      botContent: '',
      placeholder: 'Title'
    }));




  }

}



new Shop();
