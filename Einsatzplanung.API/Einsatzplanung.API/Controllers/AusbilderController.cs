using Einsatzplanung.API.Models;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;

namespace Einsatzplanung.API.Controllers
{
    public class AusbilderController : ApiController
    {
        [HttpGet]
        [Route("api/ausbilder/{persNummer}")]
        public Ausbilder GetAusbilder([FromUri] int persNummer)
        {
            using (var context = new EinsatzplanungContext())
            {
                var ausbilder = context.Ausbilder.Find(persNummer);
                if (ausbilder != null)
                    return ausbilder;
                else
                    return null;
            }
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