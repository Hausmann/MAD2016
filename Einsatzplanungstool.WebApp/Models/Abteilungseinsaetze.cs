using Einsatzplanung.API.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;

namespace Einsatzplanungstool.WebApp.Models
{
    public class Abteilungseinsaetze
    {
        public Azubi derAzubi { get; set; }

        public Einsaetze derEinsatz { get; set; }
    }
}