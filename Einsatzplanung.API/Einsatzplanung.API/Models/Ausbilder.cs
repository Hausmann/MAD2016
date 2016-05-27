using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Einsatzplanung.API.Models
{
    public class Ausbilder
    {
        public int AusbilderID { get; set;}

        public string Vorname { get; set;}

        public string Nachname { get; set;}

        public int AbteilungID { get; set;}

        public int PersNr { get; set;}
    }
}