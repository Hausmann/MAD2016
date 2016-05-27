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
            List<Azubi> listAzubis = new List<Azubi>();
            using (var context = new EinsatzplanungContext())
            {
                foreach (var einsatz in context.Einsatz)
                {
                    if(einsatz.AbteilungID == abteilungID)
                    {
                        var azubi = context.Azubis.Find(einsatz.AzubiID);
                        listAzubis.Add(azubi);
                    }
                }
                return listAzubis;
            }
        }
    }
}
