using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Einsatzplanung.API.Models
{
    public class Abteilungseinsaetze
    {
        //public Abteilungseinsaetze(Azubi azubi, Einsaetze einsatz)
        //{
        //    derAzubi = azubi;
        //    derEinsatz = einsatz;
        //}

        public Azubi derAzubi { get; set; }

        public Einsaetze derEinsatz { get; set; }


        ///*public int einsatzID { get; set; }

        //public int AbteilungID { get; set; }

        //public int AzubiID { get; set; }

        //public string VonDatum { get; set; }

        //public string BisDatum { get; set; }

        //public string Status { get; set; }*/



        //public string Vorname { get; set; }

        //public string Nachname { get; set; }

        ///*public int BerufID { get; set; }

        //public int AusbilderID { get; set; }

        //public int HeimatabteilungID { get; set; }

        //public int PersNr { get; set; }*/


        //public string KOE { get; set; }
    }
}