
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
    /*
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
    	*/



      append('body', `

      <style>

      .btn-hover {
        margin: 5px; padding: 10px;
        cursor: pointer;
        border: 2px solid gray;
        transition: .3s;
      }

          .btn-hover:hover {
            border: 2px solid yellow;
          }

      </style>

      <br>
      <div class='in' style='text-align: center;'>
          <h1>Tienda libros de ciencia ficción</h1>
      </div>
      <br>


          <form class='in' style='margin: auto; max-width: 350px; border: 3px solid yellow;'>

          </form>

      `);


      let total = 0;
      const renderBooks = () =>  {
        htmls('form', '');
        books.map( (movie, index, array) => {

           append('form', `

               <div class='in' style='border: 2px solid gray; width: 300px; margin: 5px;'>

                     Nombre Pelicula: `+movie.title+`
                     <br>
                     Precio: `+movie.amount+`
                     <br>

                     <div class='inl btn-add-`+index+` btn-hover'
                     style='background: green; color: white; `+(movie.buy?`display: none;`:'')+`'>
                         Agregar al carro
                     </div>

                     <div class='inl card-info-`+index+` btn-hover'
                     style='background: yellow; color: black; `+(movie.buy?'':`display: none;`)+`'>
                         Producto agregado
                     </div>

                     <div class='inl btn-del-`+index+` btn-hover'
                     style='background: red; color: white; `+(movie.buy?'':`display: none;`)+` padding: 5px;'>
                         Eliminar del carro
                     </div>

               </div>

           `);

                    s('.btn-add-'+index).onclick = () => {
                      books[index].buy = true;
                      total += movie.amount;
                      renderBooks();
                    };
                    s('.btn-del-'+index).onclick = () => {
                      books[index].buy = false;
                      total -= movie.amount;
                      renderBooks();
                    };
         });

         append('form', `

               <br>
               <div class='inl total' style='margin: 5px; background: white; color: green; padding: 20px; font-size: 24px;'>

                   TOTAL: $`+total+`

               </div>
               <div class='inl btn-hover clear-shop' style='background: pink; color: black; magin: 5px; padding: 5px;'>
                 vaciar carro
               </div>

               <br>

                <div class='inl buy-btn btn-hover' style='padding: 15px; margin: 5px; background: cyan; color: black; font-weight: bold;'>

                    PAGAR

                </div>

               <br>

         `);

         const resetShop = () => {
           total = 0;
           books = books.map( movie => {
             movie.buy = false;
             return movie;
           });
           renderBooks();
         };

         s('.clear-shop').onclick = () => {
           resetShop();
         }

         s('.buy-btn').onclick = () => {
           resetShop();
         }

      };

      renderBooks();

      append('body', spr('<br>', 3));





  }

}



new Shop();
