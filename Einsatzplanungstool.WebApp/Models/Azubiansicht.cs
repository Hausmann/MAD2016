using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Einsatzplanungstool.WebApp.Models
{
    public class Azubiansicht
    {
        public string Vorname { get; set; }

        public string Nachname { get; set; }

        public int PersNr { get; set; }

        public string HeimatKOE { get; set; }

        public string Fachausbilder { get; set; }

        public string Beruf { get; set; }

    }
}