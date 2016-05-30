using Einsatzplanung.API.Models;
using Einsatzplanungstool.WebApp.Models;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;

namespace Einsatzplanung.API.Controllers
{
    public class AzubiController : ApiController
    {
        [HttpGet]
        [Route("api/azubi/{azubiID}")]
        public Azubi GetAzubi([FromUri] int azubiID)
        {
            using (var context = new EinsatzplanungContext())
            {
                return context.Azubis.FirstOrDefault((azubi) => azubi.AzubiID == azubiID);
            }
        }

        [HttpGet]
        [Route("api/ausbilder/{ausbilderID}/azubis")]
        public List<Azubi> GetAzubis([FromUri] int ausbilderID)
        {
            using (var context = new EinsatzplanungContext())
            {
                var query = from a in context.Ausbilder
                            join b in context.Azubis on a.AusbilderID equals b.AusbilderID
                            where ausbilderID == b.AusbilderID
                            select b;

                List<Azubi> azubisZuAusbilder = query.ToList<Azubi>();
                return azubisZuAusbilder;
            }
        }

        [HttpGet]
        [Route("api/ausbilder/{ausbilderID}/azubiAnsicht")]
        public List<Azubiansicht> GetAzubiAnsicht([FromUri] int ausbilderID)
        {
            using (var context = new EinsatzplanungContext())
            {
                var query = from aus in context.Ausbilder
                            join azu in context.Azubis on aus.AusbilderID equals azu.AusbilderID
                            join abt in context.Abteilung on azu.HeimatabteilungID equals abt.AbteilungID
                            join beruf in context.Beruf on azu.BerufID equals beruf.BerufID
                            join fachausbilder in context.Fachausbilder on abt.AbteilungID equals fachausbilder.abteilungID
                            where ausbilderID == azu.AusbilderID
                            select new Azubiansicht()
                            {
                                Vorname = azu.Vorname,
                                Nachname = azu.Nachname,
                                PersNr = azu.PersNr,
                                HeimatKOE = abt.KOE,
                                Fachausbilder = fachausbilder.Vorname + " " + fachausbilder.Nachname,
                                Beruf = beruf.Beschreibung
                            };

                List<Azubiansicht> azubisZuAusbilder = query.ToList<Azubiansicht>();
                return azubisZuAusbilder;
            }
        }


        [HttpGet]
        [Route("api/abteilung/{abteilungsID}/azubis")]
        public List<Abteilungseinsaetze> GetAbteilungsAzubis([FromUri] int abteilungsID)
        {
            List<Azubi> listAzubisMitEinsatzInAbteilung = new List<Azubi>();
            using (var context = new EinsatzplanungContext())
            {
                var query = from abt in context.Abteilung
                            join e in context.Einsatz on abt.AbteilungID equals e.AbteilungID
                            join a in context.Azubis on e.AzubiID equals a.AzubiID
                            where abteilungsID == e.AbteilungID
                            select new Abteilungseinsaetze()
                            {
                                derAzubi = a,
                                derEinsatz = e
                            };

                List<Abteilungseinsaetze> listAll = query.ToList<Abteilungseinsaetze>();

                return listAll;
            }
        }


        [HttpPost]
        [Route("api/azubi")]
        public HttpResponseMessage PostAzubi([FromBody] Azubi newAzubi)
        {
            using (var context = new EinsatzplanungContext())
            {
                context.Azubis.Add(newAzubi);
                context.SaveChangesAsync();
            }
            return Request.CreateResponse(HttpStatusCode.OK);
        }


        [HttpGet]
        [Route("api/azubi")]
        public List<Azubi> GetAllAzubis()
        {
            using (var context = new EinsatzplanungContext())
            {
                return context.Azubis.ToList<Azubi>();
            }
        }
    }
}