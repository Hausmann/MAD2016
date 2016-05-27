using Einsatzplanung.API.Models;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using System.Web.Http.Cors;

namespace Einsatzplanung.API.Controllers
{
    [EnableCors(origins: "*", headers: "*", methods: "*")]
    public class AusbilderController : ApiController
    {
        [HttpGet]
        [Route("api/ausbilder/{persNummer}")]
        public Ausbilder GetAusbilder([FromUri] int persNummer)
        {
            using (var context = new EinsatzplanungContext())
            {
                foreach (var ausbilder in context.Ausbilder)
                {
                    if (ausbilder.PersNr == persNummer)
                        return ausbilder;
                }
            }
            return null;
        }
    
        [HttpPost]
        [Route("api/ausbilder")]
        public HttpResponseMessage PostAusbilder([FromBody] Ausbilder ausbilder)
        {
            using (var context = new EinsatzplanungContext())
            {
                context.Ausbilder.Add(ausbilder);
                context.SaveChangesAsync();
            }

            return Request.CreateResponse(HttpStatusCode.OK);
        }
    }
}