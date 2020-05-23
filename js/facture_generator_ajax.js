 /// show facture in pdf file 


 
 function show_facture(id)
 {

        $.ajax({
              url : 'action/show_facture_pdf.php',
              type : 'POST',
              data : {id : id},
              dataType : "JSON",
              success:function(data)
              {
                  generate_facture(data);
                  console.log(data);
              }
        }); 
 }

 function generate_facture(data)
 {
        

         let doc = new jsPDF();

         doc.setFontStyle("bold");
         doc.setFontSize('20');
         doc.text('Facture de vente',103.5,50,null,null,"center");
         doc.setFontSize('13');
         doc.setFontStyle("normal");
         
          
         doc.text(`Nom d'agriculteur : `, 15,76,null,null);
         doc.text(`Prénom : `, 15,84,null,null);
         doc.text(`Numéro de carte : `, 15,92,null,null);
         doc.text(`Email : `, 15,100,null,null);


         doc.text(`Nom d'office : `, 119,76,null,null);
         doc.text(`Wilaya : `, 119,84,null,null);
         doc.text(`Numéro de téléphone : `, 119,92,null,null);


         doc.text(`Date : `, 15,115,null,null);


         doc.setFontStyle("bold");
         doc.text(`${data.nom_agr}`, 54.5,76,null,null);
         doc.text(`${data.prenom_agr}`, 34.5,84,null,null);
         doc.text(`${data.carte}`, 52.8,92,null,null);
         doc.text(`${data.email_agr} `, 30.5,100,null,null);


         doc.text(`${data.office_nom} `, 148.2,76,null,null);
         doc.text(`${data.wilaya} `, 136.5,84,null,null);
         doc.text(`${data.phone}`,167.5,92,null,null);


         doc.text(`${data.date} `, 28.5,115,null,null);

        
         doc.line(15, 130, 195, 130);
         doc.text(`Produit  `, 18.5,136.5,null,null);
         doc.text(`Date  `, 55,136.5,null,null);
         doc.text(`Quantité  `, 95,136.5,null,null);
         doc.text(`Qualité  `, 135,136.5,null,null);
         doc.text(`Montant  `, 174.5,136.5,null,null);
         doc.line(15, 140, 195, 140);
       

             let cpt = 147;
             let line_cpt = 150;
            
             data.array_recolte.forEach((element) =>{
              
             
                let array_explode = element.split(',');
                
                doc.setFontStyle("normal");
                doc.text(`${array_explode[0]}  `, 18.5,cpt,null,null);
                doc.text(`${array_explode[1]}  `, 48,cpt,null,null);
                doc.text(`${array_explode[2]} `, 99.5,cpt,null,null);
                doc.text(`${array_explode[3]}  `, 141.5,cpt,null,null);
                doc.text(`${array_explode[4] } `, 174.5,cpt,null,null);

                doc.setFontStyle("bold");
                doc.line(15, line_cpt, 195, line_cpt);
                cpt +=10;
                line_cpt +=10;

         });
         // end line
         doc.setFontStyle("bold");
         doc.line(15,130,15,line_cpt-10);
         doc.line(195,130,195,line_cpt-10);

         
         doc.text(`Montant total : ${data.montant_total} DA`, 15,cpt+1,null,null)
         



         doc.save('Facture de vente '+ data.date +'.pdf');
 }