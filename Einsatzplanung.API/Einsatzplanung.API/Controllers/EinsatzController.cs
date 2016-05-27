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
        * POST api/einsatz/neu
        *
        * PUT api/einsatz/{einsatzID}/bearbeiten
        *
        * DELETE
        */

        [HttpGet]
        [Route("api/azubi/{azubiID}/einsaetze")]
        public List<Einsaetze> GetAzubiEinsaetze([FromUri] int azubiID)
        {
            using (var context = new EinsatzplanungContext())
            {
                var query = from a in context.Azubis
                            join e in context.Einsaetze on a.AzubiID equals e.AzubiID
                            join abt in context.Abteilung on e.AbteilungID equals abt.AbteilungID
                            where azubiID == e.AzubiID
                            select e;

                List<Einsaetze> azubiEinsaetze = query.ToList<Einsaetze>();
                return azubiEinsaetze; 
            }
        }

        [HttpPost]
        [Route("api/einsatz/neu")]
        public HttpResponseMessage PostAzubiEinsatz([FromBody] Einsaetze newEinsatz)
        {
            using (var context = new EinsatzplanungContext())
            {
                context.Einsaetze.Add(newEinsatz);
                context.SaveChangesAsync();
            }

            return Request.CreateResponse(HttpStatusCode.OK);
        }

         [HttpPut]
         [Route("api/einsatz/{einsatzID}/bearbeiten")]
        public HttpResponseMessage PutAzubiEinsatz([FromUri] int einsatzID, [FromBody] Einsaetze einsatz)
        {
            using (var context = new EinsatzplanungContext())
            {
                Einsaetze einsatzAusDB = context.Einsaetze.Find(einsatzID);

                if (einsatzAusDB != null)
                {
                    if(einsatz.AbteilungID != 0)
                    {
                        einsatzAusDB.AbteilungID = einsatz.AbteilungID;
                    }

                    if (einsatz.AzubiID != 0)
                    {
                        einsatzAusDB.AzubiID = einsatz.AzubiID;
                    }

                    if (!string.IsNullOrEmpty(einsatz.VonDatum))
                    {
                        einsatzAusDB.VonDatum = einsatz.VonDatum;
                    }
                    if (!string.IsNullOrEmpty(einsatz.BisDatum))
                    {
                        einsatzAusDB.BisDatum = einsatz.BisDatum;
                    }
                    if (!string.IsNullOrEmpty(einsatz.Status))
                    {
                        einsatzAusDB.Status = einsatz.Status;
                    }

                    context.SaveChangesAsync();

                    return Request.CreateResponse(HttpStatusCode.OK);
                }
                else
                {
                    return Request.CreateResponse(HttpStatusCode.NotFound);
                }
            }
            return Request.CreateResponse(HttpStatusCode.OK);
        }

    }
}
