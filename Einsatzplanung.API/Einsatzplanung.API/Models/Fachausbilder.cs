using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Einsatzplanung.API.Models
{
    public class Fachausbilder
    {
        public int FachausbilderID { get; set;}

        public string Vorname { get; set;}

        public string Nachname { get; set;}

        public int abteilungID { get; set;}

        public int PersNr { get; set;}
    }

}