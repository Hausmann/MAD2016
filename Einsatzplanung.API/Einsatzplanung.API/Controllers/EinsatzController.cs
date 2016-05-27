using Einsatzplanung.API.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;

namespace Einsatzplanung.API.Controllers
{
    public class EinsatzController : ApiController
    {
        /*
        * GET api/azubi/{azubiID}/einsaetze
        *
        *
        */

        [HttpGet]
        [Route("api/abteilung/{abteilungID}/azubis")]
        public List<Azubi> GetAzubiEinsaetze([FromUri] int abteilungID)
        {
            using (var context = new EinsatzplanungContext())
            {
                //var query = from a in context.Abteilung
                //            join b in context.Azubis on a.AbteilungID equals b.
                //            where ausbilderID == b.AusbilderID
                //            select b;
                return null;
            }
        }
    }
}
